<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTable extends Component
{
    private array $data;
    private array $headings;

    public function __construct(array $data, array $headings)
    {
        $this->data = $data;
        $this->headings = $headings;
    }

    public function render()
    {
        return view('components.data-table')
            ->with('data', $this->data)
            ->with('headings', $this->headings);
    }
}
