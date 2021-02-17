<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CountCard extends Component
{
    public $title;
    public $count;

    public function __construct($title, $count)
    {
        $this->title = $title;
        $this->count = $count;
    }

    public function render()
    {
        return view('components.count-card');
    }
}
