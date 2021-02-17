<?php

namespace App\Console\Commands;

use App\Models\Config;
use Faker\Factory;
use App\Domains\IRCContext\Infrastructure\{FindByNameNickController, UpdateNickController};
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbNickRepository as Repository;
use App\Models\Nick;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Monolog\Logger;
use Phergie\Irc\Client\React\{Client, WriteStream};
use Phergie\Irc\Connection;

class ConnectNickToServer extends \Illuminate\Console\Command
{
    protected $signature = 'irc:connectnick';
    protected $description = 'Connects oldest nick to IRC server';
    protected Config $config;

    public function __construct()
    {
        $this->config = new Config();

        parent::__construct();
    }

    public function handle()
    {
        try {
            $nick = Nick::active()->orderBy('last_use', 'asc')->first();

            if (!$nick) {
                $this->warn('There are no nicks stored in repository');
                return 1;
            }

            $client = new Client();
            $factory = new Factory();
            $faker = $factory->create('es');

            $connection = new Connection([
                'serverHostname' => $this->config->getValue('server.hostname'),
                'nickname' => $nick->password ? sprintf("%s:%s", $nick->name, $nick->password) : $nick->name,
                'username' => Str::slug(Str::random(6)),
                'realname' => sprintf("%s %s %s", $faker->title(), $faker->firstName(), $faker->lastName)
            ]);

            $client->on('irc.received', function (
                array $message,
                WriteStream $write,
                Connection $connection,
                Logger $logger
            ) use ($nick, $client) {
                $logger->useMicrosecondTimestamps(false);
                if (isset($message['command'])) {
                    match ($message['command']) {
                        '001' => $this->onRegistration($write, $nick, $client),
                        '432', '433' => $this->onNickUnavailable($write, $nick),
                        default => null
                    };
                }
            });

            $client->run($connection);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        return 0;
    }

    private function onRegistration($write, $nick, $client): bool
    {
        $this->touchLastUse($nick->name);
        $write->ircMode($nick->name, $this->config->getValue('default.modes', '+inI'));
        $write->ircJoin($this->config->getValue('channels'));

        $client->addTimer($this->config->getValue('timeout.operation', 5), function () use ($write, $client) {
            $write->ircQuit($this->config->getValue('quit.message'));
            $write->close();
            $this->info("Connection closed.");
            exit(0);
        });

        return true;
    }

    private function onNickUnavailable($write, $nick): bool
    {
        $newNick = str_shuffle($nick) . mt_rand(1, 99);
        $this->info("Nickname $nick is not available. Changing to $newNick ...");
        $write->ircNick($newNick);
        return true;
    }

    private function touchLastUse(string $nickName): void
    {
        $findController   = new FindByNameNickController(new Repository());
        $updateController = new UpdateNickController(new Repository());

        $nick = $findController->__invoke(request()->merge(['name' => $nickName]));

        if ($nick) {
            $updateController->__invoke(
                request()->merge(['id' => $nick->getId()->value(), 'last_use' => Carbon::now()])
            );

            $this->info('Updated last_use date for '.$nick->getName()->value());
        }
    }
}
