<?php

namespace App\Http\Controllers\IRC;

use App\Domains\IRCContext\Domain\Config;
use App\Domains\IRCContext\Infrastructure\GetConfigController as IRCContextGetConfigController;
use Illuminate\Http\Request;

class GetConfigController extends \App\Http\Controllers\Controller
{
    private IRCContextGetConfigController $getConfigController;

    public function __construct(IRCContextGetConfigController $getConfigController)
    {
        $this->getConfigController = $getConfigController;
    }

    public function __invoke(Request $request): Config
    {
        return $this->getConfigController->__invoke($request);
    }
}
