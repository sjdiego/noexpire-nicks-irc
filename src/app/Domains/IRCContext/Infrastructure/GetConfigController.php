<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Infrastructure;

use App\Domains\IRCContext\Application\GetConfigUseCase;
use App\Domains\IRCContext\Domain\Config;
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbConfigRepository;
use Illuminate\Http\Request;

final class GetConfigController
{
    private MongodbConfigRepository $repository;

    public function __construct(MongodbConfigRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): Config
    {
        $getConfigUseCase = new GetConfigUseCase($this->repository);

        return $getConfigUseCase->__invoke((string) $request->get('key'));
    }
}
