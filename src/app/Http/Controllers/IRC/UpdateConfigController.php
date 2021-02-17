<?php

namespace App\Http\Controllers\IRC;

use App\Domains\IRCContext\Infrastructure\UpdateConfigController as IRCContextUpdateConfigController;
use App\Models\Config;
use Illuminate\Http\Request;

class UpdateConfigController extends \App\Http\Controllers\Controller
{
    private IRCContextUpdateConfigController $updateConfigController;

    public function __construct(IRCContextUpdateConfigController $updateConfigController)
    {
        $this->updateConfigController = $updateConfigController;
    }

    public function __invoke(Request $request)
    {
        try {
            $this->updateConfigController->__invoke($request);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('irc.config'))->with('success', 'Configuración actualizada correctamente');
    }

    public function render(string $key)
    {
        $config = new Config();

        return view('irc.config-update', [
            'config' => $config->getByKey($key)
        ]);
    }
}
