<?php

namespace App\View\Components\Inputs;

use Illuminate\Support\Arr;
use Illuminate\View\Component;

class State extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.state');
    }
}
