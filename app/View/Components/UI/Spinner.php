<?php

namespace App\View\Components\UI;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Spinner extends Component
{
    public string $size;
    public string $color;

    public function __construct(string $size = '6', string $color = 'blue-500')
    {
        $this->size = $size;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.spinner');
    }
}
