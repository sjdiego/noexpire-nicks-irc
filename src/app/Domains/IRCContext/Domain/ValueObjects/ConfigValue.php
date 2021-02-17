<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Domain\ValueObjects;

final class ConfigValue
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
