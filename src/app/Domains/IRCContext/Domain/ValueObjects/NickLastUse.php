<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Domain\ValueObjects;

use Carbon\Carbon;

final class NickLastUse
{
    private Carbon|null $value;

    public function __construct(Carbon|null $date)
    {
        $this->value = $date;
    }

    public function value(): Carbon|null
    {
        return $this->value;
    }
}
