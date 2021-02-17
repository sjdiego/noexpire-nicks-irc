<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Infrastructure\Repositories;

use App\Domains\IRCContext\Domain\Contracts\ConfigRepositoryContract;
use App\Domains\IRCContext\Domain\Config;
use App\Domains\IRCContext\Domain\ValueObjects\{ConfigKey, ConfigValue, ConfigType};
use App\Models\Config as EloquentMongodbModel;

class MongodbConfigRepository implements ConfigRepositoryContract
{
    private EloquentMongodbModel $eloquentMongodbModel;

    public function __construct()
    {
        $this->eloquentMongodbModel = new EloquentMongodbModel();
    }

    public function list(): array
    {
        $data = $this->eloquentMongodbModel->all();

        return $data->map(function ($eloquentConfig) {
            return new Config(
                key:    new ConfigKey($eloquentConfig->key),
                value:  new ConfigValue($eloquentConfig->value),
                type:   new ConfigType($eloquentConfig->type),
            );
        })->toArray();
    }

    public function get(ConfigKey $key): Config|bool
    {
        $eloquentConfig = $this->eloquentMongodbModel
            ->where(['key' => $key->value()])
            ->first();

        if ($eloquentConfig) {
            return new Config(
                key:    new ConfigKey($eloquentConfig->key),
                value:  new ConfigValue($eloquentConfig->value),
                type:   new ConfigType($eloquentConfig->type),
            );
        }

        return false;
    }

    public function create(Config $config): Config
    {
        $eloquentConfig = $this->eloquentMongodbModel->create([
            'key'   => $config->getKey()->value(),
            'value' => $config->getValue()->value(),
            'type'  => $config->getType()->value(),
        ]);

        return new Config(
            key:    new ConfigKey($eloquentConfig->key),
            value:  new ConfigValue($eloquentConfig->value),
            type:   new ConfigType($eloquentConfig->type),
        );
    }

    public function update(ConfigKey $key, Config $config): bool
    {
        return !! $this->eloquentMongodbModel
            ->getByKey($key->value())
            ->update(
                [
                    'key'   => $config->getKey()->value(),
                    'value' => $config->getValue()->value(),
                    'type'  => $config->getType()->value(),
                ]
            );
    }

    public function delete(ConfigKey $key): bool
    {
        return $this->eloquentMongodbModel
            ->getByKey($key->value())
            ->delete();
    }
}
