<?php

declare(strict_types=1);

namespace App\View\Components\UI;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Card extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $image, public string $title, public string $description, public string $link) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.ui.card');
    }
}
