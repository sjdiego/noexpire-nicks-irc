<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Application;

use App\Domains\IRCContext\Domain\Contracts\NickRepositoryContract;
use App\Domains\IRCContext\Domain\Nick;
use App\Domains\IRCContext\Domain\ValueObjects\{NickIsActive, NickLastUse, NickName, NickPassword, NickUserId};
use Carbon\Carbon;

final class CreateNickUseCase
{
    private NickRepositoryContract $repository;

    public function __construct(NickRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $name,
        string $password,
        bool $isActive,
        Carbon|null $lastUse,
        string $userId
    ): Nick
    {
        $nick = Nick::create(
            name: new NickName($name),
            password: new NickPassword($password),
            isActive: new NickIsActive($isActive),
            lastUse: new NickLastUse($lastUse),
            userId: new NickUserId($userId)
        );

        if ($this->repository->findByName(new NickName($name))) {
            throw new \InvalidArgumentException(
                sprintf("%s nickname already exists in repository", $name)
            );
        }

        return $this->repository->create($nick);
    }
}
