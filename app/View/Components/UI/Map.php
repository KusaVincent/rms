<?php

declare(strict_types=1);

namespace App\View\Components\UI;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Map extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.ui.map');
    }
}
