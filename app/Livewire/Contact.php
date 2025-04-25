<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use App\Models\Contact as ModelsContact;
final class Contact extends Component
{
    public function render(): View
    {
        return view('livewire.contact', [
            'contacts' => ModelsContact::where('section', '!=', 'footer')->get(),
        ]);
    }
}
