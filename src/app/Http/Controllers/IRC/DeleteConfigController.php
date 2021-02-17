<?php

namespace App\Http\Controllers\IRC;

use App\Domains\IRCContext\Infrastructure\DeleteConfigController as IRCContextDeleteConfigController;
use App\Models\Config;
use Illuminate\Http\Request;

class DeleteConfigController extends \App\Http\Controllers\Controller
{
    private IRCContextDeleteConfigController $deleteConfigController;

    public function __construct(IRCContextDeleteConfigController $deleteConfigController)
    {
        $this->deleteConfigController = $deleteConfigController;
    }

    public function __invoke(Request $request)
    {
        try {
            $this->deleteConfigController->__invoke($request);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('irc.config'))->with('success', 'Configuración eliminada correctamente');
    }

    public function render(string $key)
    {
        $config = new Config();

        return view('irc.config-delete', ['config' => $config->getByKey($key)]);
    }
}
