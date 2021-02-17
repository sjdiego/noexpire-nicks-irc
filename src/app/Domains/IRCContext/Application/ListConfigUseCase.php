<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Application;

use App\Domains\IRCContext\Domain\Contracts\ConfigRepositoryContract;

final class ListConfigUseCase
{
    private ConfigRepositoryContract $repository;

    public function __construct(ConfigRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->list();
    }
}
