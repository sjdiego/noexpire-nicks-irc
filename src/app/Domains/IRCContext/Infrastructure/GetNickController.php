<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Infrastructure;

use App\Domains\IRCContext\Application\GetNickUseCase;
use App\Domains\IRCContext\Domain\Nick;
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbNickRepository;
use Illuminate\Http\Request;

final class GetNickController
{
    private MongodbNickRepository $repository;

    public function __construct(MongodbNickRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): Nick
    {
        $getNickUseCase = new GetNickUseCase($this->repository);

        return $getNickUseCase->__invoke((string) $request->get('id'));
    }
}
