<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Domain\ValueObjects;

final class NickPassword
{
    private string $value;

    public function __construct(string $password)
    {
        $this->value = $password;
    }

    public function value(): string
    {
        return $this->value;
    }
}
