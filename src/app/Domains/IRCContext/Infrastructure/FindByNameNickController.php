<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Infrastructure;

use App\Domains\IRCContext\Application\FindByNameNickUseCase;
use App\Domains\IRCContext\Domain\Nick;
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbNickRepository;
use Illuminate\Http\Request;

final class FindByNameNickController
{
    private MongodbNickRepository $repository;

    public function __construct(MongodbNickRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): Nick|bool
    {
        $findByNameNickUseCase = new FindByNameNickUseCase($this->repository);

        return $findByNameNickUseCase->__invoke((string) $request->get('name'));
    }
}
