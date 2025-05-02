<?php

namespace Components\UI;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ZoomModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.ui.zoom-modal');
    }
}
