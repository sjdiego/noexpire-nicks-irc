<?php

namespace App\Http\Controllers\IRC;

use App\Domains\IRCContext\Infrastructure\DeleteNickController as IRCContextDeleteNickController;
use App\Models\Nick;
use Illuminate\Http\Request;

class DeleteNickController extends \App\Http\Controllers\Controller
{
    private IRCContextDeleteNickController $deleteNickController;

    public function __construct(IRCContextDeleteNickController $deleteNickController)
    {
        $this->deleteNickController = $deleteNickController;
    }

    public function __invoke(Request $request)
    {
        try {
            $this->deleteNickController->__invoke($request);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('irc.nicks'))->with('success', 'Nick eliminado correctamente');
    }

    public function render($id)
    {
        $nick = Nick::findOrFail($id);

        return view('irc.nicks-delete', ['nick' => $nick]);
    }
}
