<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Domain\ValueObjects;

final class ConfigType
{
    private string $value;

    public function __construct(string $type)
    {
        $this->value = $type;
    }

    public function value(): string
    {
        return $this->value;
    }
}
