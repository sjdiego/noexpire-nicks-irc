<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Infrastructure;

use App\Domains\IRCContext\Application\{CreateNickUseCase, GetNickUseCase};
use App\Domains\IRCContext\Domain\Nick;
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbNickRepository;
use Illuminate\Http\Request;

final class CreateNickController
{
    private MongodbNickRepository $repository;

    public function __construct(MongodbNickRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): Nick
    {
        $getNickUseCase    = new GetNickUseCase($this->repository);
        $createNickUseCase = new CreateNickUseCase($this->repository);

        $nick = $createNickUseCase->__invoke(
            name: (string) $request->input('name'),
            password: (string) $request->input('password'),
            isActive: (bool) $request->input('is_active'),
            lastUse: null,
            userId: (string) $request->input('user_id')
        );

        return $getNickUseCase->__invoke($nick->getId()->value());
    }
}
