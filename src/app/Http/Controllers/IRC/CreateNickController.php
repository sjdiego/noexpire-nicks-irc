<?php

namespace App\Http\Controllers\IRC;

use App\Domains\IRCContext\Infrastructure\CreateNickController as IRCContextCreateNickController;
use Illuminate\Http\Request;

class CreateNickController extends \App\Http\Controllers\Controller
{
    private IRCContextCreateNickController $createNickController;

    public function __construct(IRCContextCreateNickController $createNickController)
    {
        $this->createNickController = $createNickController;
    }

    public function __invoke(Request $request)
    {
        try {
            $request->merge(['user_id' => auth()->id()]);

            $this->createNickController->__invoke($request);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('irc.nicks'))->with('success', 'Nick creado correctamente');
    }

    public function render()
    {
        return view('irc.nicks-create');
    }
}
