<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Infrastructure;

use App\Domains\IRCContext\Application\DeleteConfigUseCase;
use App\Domains\IRCContext\Domain\ValueObjects\ConfigKey;
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbConfigRepository;
use Illuminate\Http\Request;

class DeleteConfigController
{
    private MongodbConfigRepository $repository;

    public function __construct(MongodbConfigRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): bool
    {
        $deleteConfigUseCase = new DeleteConfigUseCase($this->repository);

        return $deleteConfigUseCase->__invoke(new ConfigKey($request->input('key')));
    }
}
