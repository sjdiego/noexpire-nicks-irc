<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Infrastructure;

use App\Domains\IRCContext\Application\ListNickUseCase;
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbNickRepository;
use Illuminate\Http\Request;

final class ListNickController
{
    private MongodbNickRepository $repository;

    public function __construct(MongodbNickRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): ?array
    {
        $listNickUseCase = new ListNickUseCase($this->repository);

        return $listNickUseCase->__invoke();
    }
}
