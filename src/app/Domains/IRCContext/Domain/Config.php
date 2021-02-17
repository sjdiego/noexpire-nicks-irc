<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Domain;

use App\Domains\IRCContext\Domain\ValueObjects\{ConfigKey, ConfigType, ConfigValue};

/**
 * Class Config
 * @package App\Domains\IRCContext\Domain
 */
final class Config
{
    private ConfigKey $key;
    private ConfigValue $value;
    private ConfigType $type;

    /**
     * Config constructor.
     * @param ConfigKey   $key
     * @param ConfigValue $value
     * @param ConfigType  $type
     */
    public function __construct(ConfigKey $key, ConfigValue $value, ConfigType $type)
    {
        $this->key = $key;
        $this->value = $value;
        $this->type = $type;
    }

    /**
     * @return ConfigKey
     */
    public function getKey(): ConfigKey
    {
        return $this->key;
    }

    /**
     * @return ConfigValue
     */
    public function getValue(): ConfigValue
    {
        return $this->value;
    }

    /**
     * @return ConfigType
     */
    public function getType(): ConfigType
    {
        return $this->type;
    }

    /**
     * @param ConfigKey   $key
     * @param ConfigValue $value
     * @param ConfigType  $type
     * @return Config
     */
    public static function create(
        ConfigKey $key,
        ConfigValue $value,
        ConfigType $type
    ): Config {
        return new self(
            key: $key,
            value: $value,
            type: $type
        );
    }
}
