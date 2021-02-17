<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Domain\ValueObjects;

final class NickUserId
{
    private string $value;

    public function __construct(string $uid)
    {
        $this->value = $uid;
    }

    public function value(): string
    {
        return $this->value;
    }
}
