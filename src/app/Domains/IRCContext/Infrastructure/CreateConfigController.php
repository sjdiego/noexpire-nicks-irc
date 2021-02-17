<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Infrastructure;

use App\Domains\IRCContext\Application\{CreateConfigUseCase, GetConfigUseCase};
use App\Domains\IRCContext\Domain\Config;
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbConfigRepository;
use Illuminate\Http\Request;

final class CreateConfigController
{
    private MongodbConfigRepository $repository;

    public function __construct(MongodbConfigRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): Config
    {
        $getConfigUseCase    = new GetConfigUseCase($this->repository);
        $createConfigUseCase = new CreateConfigUseCase($this->repository);

        $config = $createConfigUseCase->__invoke(
            key:    (string) $request->input('key'),
            value:  (string) $request->input('value'),
            type:   (string) $request->input('type'),
        );

        return $getConfigUseCase->__invoke($config->getKey()->value());
    }
}
