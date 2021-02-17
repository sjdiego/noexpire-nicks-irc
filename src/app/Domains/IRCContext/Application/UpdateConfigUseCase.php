<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Application;

use App\Domains\IRCContext\Domain\Config;
use App\Domains\IRCContext\Domain\ValueObjects\{ConfigKey, ConfigValue, ConfigType};
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbConfigRepository;

final class UpdateConfigUseCase
{
    private MongodbConfigRepository $repository;

    public function __construct(MongodbConfigRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $key,
        string $value,
        string $type,
    )
    {
        $config = Config::create(
            key: new ConfigKey($key),
            value: new ConfigValue($value),
            type: new ConfigType($type),
        );

        $this->repository->update(new ConfigKey($config->getKey()->value()), $config);
    }
}
