<?php

namespace App\View\Components\UI;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public string $image;
    public string $title;
    public string $description;
    public string $link;
    /**
     * Create a new component instance.
     */
    public function __construct($image, $title, $description, $link)
    {
        $this->image = $image;
        $this->title = $title;
        $this->description = $description;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.card');
    }
}
