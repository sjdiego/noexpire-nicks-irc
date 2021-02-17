<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Domain\ValueObjects;

use Illuminate\Support\Str;

final class ConfigKey
{
    private string $value;

    public function __construct(string $key)
    {
        $this->value = Str::slug($key, '.');
    }

    public function value(): string
    {
        return $this->value;
    }
}
