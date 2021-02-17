<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Application;

use App\Domains\IRCContext\Domain\ValueObjects\NickId;
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbNickRepository;

class DeleteNickUseCase
{
    private MongodbNickRepository $repository;

    public function __construct(MongodbNickRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(NickId $nickId): bool
    {
        return $this->repository->delete($nickId);
    }
}
