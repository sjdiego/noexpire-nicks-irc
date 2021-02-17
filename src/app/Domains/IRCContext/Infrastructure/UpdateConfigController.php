<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Infrastructure;

use App\Domains\IRCContext\Application\{GetConfigUseCase, UpdateConfigUseCase};
use App\Domains\IRCContext\Domain\Config;
use App\Domains\IRCContext\Infrastructure\Repositories\MongodbConfigRepository;
use Illuminate\Http\Request;

class UpdateConfigController
{
    private MongodbConfigRepository $repository;

    public function __construct(MongodbConfigRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): Config
    {
        $getConfigUseCase    = new GetConfigUseCase($this->repository);
        $updateConfigUseCase = new UpdateConfigUseCase($this->repository);

        $configKey = (string) $request->input('key');
        $config   = $getConfigUseCase->__invoke($configKey);

        $key = $request->has('key')
            ? (string) $request->input('key')
            : $config->getKey()->value();

        $value = $request->has('value')
            ? (string) $request->input('value')
            : $config->getValue()->value();

        $type = $request->has('type')
            ? (string) $request->input('type')
            : $config->getType()->value();

        $updateConfigUseCase->__invoke($key, $value, $type);

        return $getConfigUseCase->__invoke($key);
    }
}
