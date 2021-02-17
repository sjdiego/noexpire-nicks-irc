<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Infrastructure;

use App\Domains\IRCContext\Application\ListConfigUseCase;
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbConfigRepository;
use Illuminate\Http\Request;

final class ListConfigController
{
    private MongodbConfigRepository $repository;

    public function __construct(MongodbConfigRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): ?array
    {
        $listConfigUseCase = new ListConfigUseCase($this->repository);

        return $listConfigUseCase->__invoke();
    }
}
