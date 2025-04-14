<?php

declare(strict_types=1);

namespace App\View\Components\UI;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class SearchBox extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $wireModel = '', public string $placeholder = 'Search...') {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.ui.search-box');
    }
}
