<?php

declare(strict_types=1);

namespace App\View\Components\Contact;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class ContactForm extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.contact.contact-form');
    }
}
