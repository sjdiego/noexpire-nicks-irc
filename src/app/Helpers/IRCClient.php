<?php

namespace App\Helpers;

use Phergie\Irc\Parser;
use Socket\Raw\Factory;
use Socket\Raw\Socket;
use Symfony\Component\Console\Output\ConsoleOutput;

class IRCClient
{
    protected Socket $socket;
    protected string $nick;
    protected string $ident;
    protected string $realName;
    protected bool $debug;

    static string $host = "irc.chathispano.com";
    static int $port = 6667;

    public function __construct($nick, $ident = 'user', $realName = 'PHP IRC Client', $debug = false)
    {
        $this->nick = $nick;
        $this->ident = $ident;
        $this->realName = $realName;
        $this->debug = $debug;
    }

    public function connect()
    {
        $factory = new Factory();
        $this->socket = $factory->createTcp4()->setBlocking(true);

        if (false === $this->socket->connect(sprintf('%s:%s', self::$host, self::$port))) {
            return null;
        }

        $this->setNick($this->nick);
        $this->setUser();
    }

    public function setNick($nick)
    {
        $this->nick = $nick;
        $this->send(sprintf("NICK %s", $nick));
    }

    public function setUser()
    {
        $this->send(sprintf("USER %s 0 * %s", $this->ident, $this->realName));
    }

    public function join($channel): void
    {
        $this->send(sprintf("JOIN #%s", $channel));
    }

    public function mode($modes): void
    {
        $this->send(sprintf("MODE %s :%s", $this->nick, $modes));
    }

    public function isConnected(): bool
    {
        return !is_null($this->socket);
    }

    public function read($size = 512): array|null
    {
        if (!$this->isConnected()) {
            return null;
        }

        $parser = new Parser();
        $lines = $parser->parseAll($this->socket->read($size));

        foreach ($lines as $line) {
            $this->handleRecv($line);
        }

        return $lines;
    }

    public function send($message): int|null
    {
        if ($this->debug) {
            $console = new ConsoleOutput();
            $console->writeln("-> $message");
        }

        return $this->isConnected() ? $this->socket->write($message . "\n") : null;
    }

    public function close(): Socket
    {
        return $this->socket->close();
    }

    private function handleRecv(array $line): void
    {
        if ($this->debug &&
            array_key_exists('message', $line) &&
            '372' != $line['command']
        ) {
            $console = new ConsoleOutput();
            $console->write("<- ${line['message']}");
        }

        if (isset($line['command']) && $cmd = $line['command']) {
            match ($cmd) {
                'PING'  => $this->send(sprintf('PONG %s', $line['params']['all'])),
                'ERROR' => $this->close(),
                default => null,
            };
        }
    }
}
