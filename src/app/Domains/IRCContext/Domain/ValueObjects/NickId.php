<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Domain\ValueObjects;

final class NickId
{
    private string $value;

    public function __construct(string $id)
    {
        $this->value = $id;
    }

    public function value(): string
    {
        return $this->value;
    }
}
