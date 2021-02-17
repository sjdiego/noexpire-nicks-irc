<?php

namespace App\Http\Controllers\IRC;

use App\Models\Nick;

class IndexNickController extends \App\Http\Controllers\Controller
{
    public function render()
    {
        return view('irc.index')
            ->with('nickCount', Nick::count())
            ->with('lastNick', Nick::orderBy('created_at', 'desc')->first());
    }
}
