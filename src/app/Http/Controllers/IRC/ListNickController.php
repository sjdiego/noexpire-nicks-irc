<?php

namespace App\Http\Controllers\IRC;

use App\Domains\IRCContext\Infrastructure\ListNickController as IRCContextListNickController;
use App\Http\Resources\IRC\NickCollection;
use App\Models\Nick;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListNickController extends \App\Http\Controllers\Controller
{
    private IRCContextListNickController $listNickController;

    public function __construct(IRCContextListNickController $listNickController)
    {
        $this->listNickController = $listNickController;
    }

    public function __invoke(Request $request)
    {
        $nickList = $this->listNickController->__invoke($request);
        $list = [];

        foreach ($nickList as $nick) {
            $list[] = [
                'id' => $nick->getId()->value(),
                'name' => $nick->getName()->value(),
                'password' => $nick->getPassword()->value(),
                'is_active' => $nick->getIsActive()->value(),
                'last_use' => $nick->getLastUse()->value(),
                'userId' => $nick->getUserId()->value(),
                'updateRoute' => route('irc.nicks-update', [
                    'id' => $nick->getId()->value()
                ]),
                'deleteRoute' => route('irc.nicks-delete', [
                    'id' => $nick->getId()->value()
                ]),
            ];
        }

        return view('irc.nicks')
            ->with('nickList', $list)
            ->with('headings', [
                ['key' => 'name',       'value' => __('messages.name')],
                ['key' => 'is_active',  'value' => __('messages.active')],
                ['key' => 'last_use',   'value' => __('messages.last_use')],
            ]);
    }
}
