<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;

class ConfigDataSeeder extends Seeder
{
    public function run()
    {
        Config::create(['key' => 'channels', 'value' => '#channel', 'type' => 'text']);
        Config::create(['key' => 'default.modes', 'value' => '+inI', 'type' => 'text']);
        Config::create(['key' => 'server.hostname', 'value' => 'irc.chathispano.com', 'type' => 'text']);
        Config::create(['key' => 'timeout.operation', 'value' => '15', 'type' => 'text']);
        Config::create(['key' => 'quit.message', 'value' => 'Connection finished.', 'type' => 'text']);
    }
}
