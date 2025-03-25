<?php

namespace App\View\Components\Contact;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContactItem extends Component
{
    public string $icon;
    public string $label;
    public string $link;
    public string $linkText;

    public function __construct($icon, $label, $link, $linkText)
    {
        $this->icon = $icon;
        $this->label = $label;
        $this->link = $link;
        $this->linkText = $linkText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact.contact-item');
    }
}
