<?php

namespace App\Http\Controllers\IRC;

use App\Domains\IRCContext\Infrastructure\CreateConfigController as IRCContextCreateConfigController;
use App\Http\Requests\ConfigRequest;

class CreateConfigController extends \App\Http\Controllers\Controller
{
    private IRCContextCreateConfigController $createConfigController;

    public function __construct(IRCContextCreateConfigController $createConfigController)
    {
        $this->createConfigController = $createConfigController;
    }

    public function __invoke(ConfigRequest $request)
    {
        try {
            $this->createConfigController->__invoke($request);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('irc.config'))
            ->with('success', 'Configuración creada correctamente');
    }

    public function render()
    {
        return view('irc.config-create');
    }
}
