<?php

declare(strict_types=1);

namespace App\View\Components\UI;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class SearchSpinner extends Component
{
    public function __construct(public string $size = '6', public string $color = 'blue-500') {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.ui.search-spinner');
    }
}
