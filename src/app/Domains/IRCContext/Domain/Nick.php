<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Domain;

use Carbon\Carbon;
use App\Domains\IRCContext\Domain\ValueObjects\{NickId, NickIsActive, NickLastUse, NickName, NickPassword, NickUserId};

final class Nick
{
    private NickId $id;
    private NickName $name;
    private NickPassword $password;
    private NickIsActive $isActive;
    private NickLastUse $lastUse;
    private NickUserId $userId;

    public function __construct(
        NickName $name,
        NickPassword $password,
        NickIsActive $isActive,
        NickLastUse $lastUse,
        NickUserId $userId,
    )
    {
        $this->name = $name;
        $this->password = $password;
        $this->isActive = $isActive;
        $this->lastUse = $lastUse;
        $this->userId = $userId;
    }

    public function getId(): NickId
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = new NickId($id);
    }

    public function getName(): NickName
    {
        return $this->name;
    }

    public function getPassword(): NickPassword
    {
        return $this->password;
    }

    public function getIsActive(): NickIsActive
    {
        return $this->isActive;
    }

    public function getLastUse(): NickLastUse
    {
        return $this->lastUse;
    }

    public function setLastUse(Carbon $lastUse): void
    {
        $this->lastUse = new NickLastUse($lastUse);
    }

    public function hasLastUse(): bool
    {
        return !! $this->lastUse;
    }

    public function getUserId(): NickUserId
    {
        return $this->userId;
    }

    public static function create(
        NickName $name,
        NickPassword $password,
        NickIsActive $isActive,
        NickLastUse $lastUse,
        NickUserId $userId
    ): Nick
    {
        return new self (
            name: $name,
            password: $password,
            isActive: $isActive,
            lastUse: $lastUse,
            userId: $userId
        );
    }
}
