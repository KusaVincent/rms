<?php

declare(strict_types=1);

namespace App\View\Components\Contact;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class ContactItem extends Component
{
    public function __construct(public string $icon, public string $label, public string $link, public string $linkText) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.contact.contact-item');
    }
}
