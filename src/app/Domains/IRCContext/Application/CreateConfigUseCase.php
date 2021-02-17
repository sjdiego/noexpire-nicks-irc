<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Application;

use App\Domains\IRCContext\Domain\Contracts\ConfigRepositoryContract;
use App\Domains\IRCContext\Domain\Config;
use App\Domains\IRCContext\Domain\ValueObjects\{ConfigKey, ConfigValue, ConfigType};

final class CreateConfigUseCase
{
    private ConfigRepositoryContract $repository;

    public function __construct(ConfigRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $key,
        string $value,
        string $type
    ): Config
    {
        $config = Config::create(
            key: new ConfigKey($key),
            value: new ConfigValue($value),
            type: new ConfigType($type),
        );

        if ($this->repository->get(new ConfigKey($key))) {
            throw new \InvalidArgumentException(
                sprintf("%s key already exists in repository", $config->getKey()->value())
            );
        }

        return $this->repository->create($config);
    }
}
