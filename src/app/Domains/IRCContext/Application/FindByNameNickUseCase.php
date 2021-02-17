<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Application;

use App\Domains\IRCContext\Domain\Contracts\NickRepositoryContract;
use App\Domains\IRCContext\Domain\Nick;
use App\Domains\IRCContext\Domain\ValueObjects\NickName;

final class FindByNameNickUseCase
{
    private NickRepositoryContract $repository;

    public function __construct(NickRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $name): Nick|bool
    {
        return $this->repository->findByName(new NickName($name));
    }
}
