<?php

namespace App\View\Components\UI;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchBox extends Component
{
    public string $wireModel;
    public string $placeholder;

    /**
     * Create a new component instance.
     *
     * @param string $wireModel
     * @param string $placeholder
     */
    public function __construct($wireModel = '', $placeholder = 'Search...')
    {
        $this->wireModel = $wireModel;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.search-box');
    }
}
