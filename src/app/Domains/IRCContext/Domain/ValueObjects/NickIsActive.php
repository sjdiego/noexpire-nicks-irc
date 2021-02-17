<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Domain\ValueObjects;

class NickIsActive
{
    private bool $value;

    public function __construct(bool $is_active = true)
    {
        $this->value = $is_active;
    }

    public function value(): bool
    {
        return $this->value;
    }
}