<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Application;

use App\Domains\IRCContext\Domain\Contracts\NickRepositoryContract;
use App\Domains\IRCContext\Domain\Nick;
use App\Domains\IRCContext\Domain\ValueObjects\NickId;

final class GetNickUseCase
{
    private NickRepositoryContract $repository;

    public function __construct(NickRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): Nick
    {
        return $this->repository->find(new NickId($id));
    }
}
