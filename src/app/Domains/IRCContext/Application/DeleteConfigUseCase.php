<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Application;

use App\Domains\IRCContext\Domain\ValueObjects\ConfigKey;
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbConfigRepository;

class DeleteConfigUseCase
{
    private MongodbConfigRepository $repository;

    public function __construct(MongodbConfigRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ConfigKey $key): bool
    {
        return $this->repository->delete($key);
    }
}
