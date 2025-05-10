<?php

declare(strict_types=1);

namespace App\Livewire\Welcome;

use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

final class Footer extends Component
{
    public string $margin = '';

    public function mount(): void
    {
        if (Route::currentRouteName() === 'home' || Route::currentRouteName() === 'properties') {
            $this->margin = 'mt-10';
        }
    }

    public function render(): View
    {
        return view('livewire.welcome.footer', [
            'contacts' => Contact::whereNot('section', 'contact')->get(),
        ]);
    }
}
