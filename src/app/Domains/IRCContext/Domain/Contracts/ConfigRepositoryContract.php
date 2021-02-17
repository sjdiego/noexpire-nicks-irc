<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Domain\Contracts;

use App\Domains\IRCContext\Domain\Config;
use App\Domains\IRCContext\Domain\ValueObjects\ConfigKey;

interface ConfigRepositoryContract
{
    public function list(): array;

    public function get(ConfigKey $key): Config|bool;

    public function create(Config $config): Config;

    public function update(ConfigKey $key, Config $config): bool;

    public function delete(ConfigKey $key): bool;
}
