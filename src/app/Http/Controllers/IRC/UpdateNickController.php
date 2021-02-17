<?php

namespace App\Http\Controllers\IRC;

use App\Domains\IRCContext\Infrastructure\UpdateNickController as IRCContextUpdateNickController;
use App\Models\Nick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateNickController extends \App\Http\Controllers\Controller
{
    private IRCContextUpdateNickController $updateNickController;

    public function __construct(IRCContextUpdateNickController $updateNickController)
    {
        $this->updateNickController = $updateNickController;
    }

    public function __invoke(Request $request)
    {
        try {
            $request->merge(['user_id' => Auth::id()]);

            $this->updateNickController->__invoke($request);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('irc.nicks'))->with('success', 'Nick actualizado correctamente');
    }

    public function render(string $id)
    {
        $nick = new Nick();

        return view('irc.nicks-update', [
            'nick' => $nick->findOrFail($id)
        ]);
    }
}
