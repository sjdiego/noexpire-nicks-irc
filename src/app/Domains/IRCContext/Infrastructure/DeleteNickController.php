<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Infrastructure;

use App\Domains\IRCContext\Application\DeleteNickUseCase;
use App\Domains\IRCContext\Domain\ValueObjects\NickId;
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbNickRepository;
use Illuminate\Http\Request;

class DeleteNickController
{
    private MongodbNickRepository $repository;

    public function __construct(MongodbNickRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): bool
    {
        $deleteNickUseCase = new DeleteNickUseCase($this->repository);

        return $deleteNickUseCase->__invoke(new NickId($request->input('id')));
    }
}
