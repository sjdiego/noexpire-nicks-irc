<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Application;

use App\Domains\IRCContext\Domain\Nick;
use Carbon\Carbon;
use App\Domains\IRCContext\Domain\ValueObjects\{NickId, NickIsActive, NickLastUse, NickName, NickPassword, NickUserId};
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbNickRepository;

final class UpdateNickUseCase
{
    private MongodbNickRepository $repository;

    public function __construct(MongodbNickRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $name,
        string $password,
        bool $isActive,
        Carbon|null $lastUse,
        string $userId
    )
    {
        $nick = Nick::create(
            name: new NickName($name),
            password: new NickPassword($password),
            isActive: new NickIsActive($isActive),
            lastUse: new NickLastUse($lastUse),
            userId: new NickUserId($userId)
        );

        $this->repository->update(new NickId($id), $nick);
    }
}
