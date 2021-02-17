<?php

namespace App\Http\Controllers\IRC;

use App\Domains\IRCContext\Infrastructure\ListConfigController as IRCContextListConfigController;
use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;

class ListConfigController extends Controller
{
    private IRCContextListConfigController $listConfigController;

    public function __construct(IRCContextListConfigController $listConfigController)
    {
        $this->listConfigController = $listConfigController;
    }

    public function __invoke(Request $request)
    {
        $configList = $this->listConfigController->__invoke($request);
        $list = [];

        foreach ($configList as $config) {
            $list[] = [
                'key' => $config->getKey()->value(),
                'value' => $config->getValue()->value(),
                'updateRoute' => route('irc.config-update', [
                    'key' => $config->getKey()->value()
                ]),
                'deleteRoute' => route('irc.config-delete', [
                    'key' => $config->getKey()->value()
                ]),
            ];
        }

        return view('irc.config')
            ->with('configList', $list)
            ->with('headings', [
                ['key' => 'key', 'value' => __('messages.key')],
                ['key' => 'value', 'value' => __('messages.value')],
            ]);
    }
}
