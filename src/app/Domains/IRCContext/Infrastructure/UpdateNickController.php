<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Infrastructure;

use App\Domains\IRCContext\Application\{GetNickUseCase, UpdateNickUseCase};
use App\Domains\IRCContext\Domain\Nick;
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbNickRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UpdateNickController
{
    private MongodbNickRepository $repository;

    public function __construct(MongodbNickRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): Nick
    {
        $getNickUseCase    = new GetNickUseCase($this->repository);
        $updateNickUseCase = new UpdateNickUseCase($this->repository);

        $nickId = (string) $request->input('id');
        $nick   = $getNickUseCase->__invoke($nickId);

        $name = $request->has('name')
            ? (string) $request->input('name')
            : $nick->getName()->value();

        $password = $request->has('password')
            ? (string) $request->input('password')
            : $nick->getPassword()->value();

        $isActive = $request->has('is_active')
            ? (bool) $request->input('is_active')
            : $nick->getIsActive()->value();

        $lastUse = $request->has('last_use')
            ? Carbon::parse($request->input('last_use'))
            : $nick->getLastUse()->value();

        $userId = $request->has('user_id')
            ? (string) $request->input('user_id')
            : $nick->getUserId()->value();

        $updateNickUseCase->__invoke($nickId, $name, $password, $isActive, $lastUse, $userId);

        return $getNickUseCase->__invoke($nickId);
    }
}
