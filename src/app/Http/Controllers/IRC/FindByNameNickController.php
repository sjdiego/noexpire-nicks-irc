<?php

namespace App\Http\Controllers\IRC;

use App\Domains\IRCContext\Infrastructure\FindByNameNickController as IRCContextFindByNameNickController;
use App\Http\Resources\IRC\NickResource;
use Illuminate\Http\{JsonResponse, Request, Response};

class FindByNameNickController extends \App\Http\Controllers\Controller
{
    private IRCContextFindByNameNickController $findByNameNickController;

    public function __construct(IRCContextFindByNameNickController $findByNameNickController)
    {
        $this->findByNameNickController = $findByNameNickController;
    }

    public function __invoke(Request $request): Response
    {
        return response(
            new NickResource($this->findByNameNickController->__invoke($request)),
            JsonResponse::HTTP_ACCEPTED
        );
    }
}
