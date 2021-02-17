<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Application;

use App\Domains\IRCContext\Domain\Contracts\ConfigRepositoryContract;
use App\Domains\IRCContext\Domain\Config;
use App\Domains\IRCContext\Domain\ValueObjects\ConfigKey;

final class GetConfigUseCase
{
    private ConfigRepositoryContract $repository;

    public function __construct(ConfigRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $key): Config|bool
    {
        return $this->repository->get(new ConfigKey($key));
    }
}
