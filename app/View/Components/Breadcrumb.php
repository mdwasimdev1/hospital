<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $items;
    public $show;

    public function __construct($items = [], $show = false)
    {
        $this->items = $items;
        $this->show = $show;
    }

    public function render()
    {
        return view('components.breadcrumb');
    }
}


