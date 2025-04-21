<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use App\Models\Property;

final class Start extends Component
{
    public function render(): View
    {
        $start = Property::count();

        return view('livewire.start', [
            'sale' => $start,
            'agents' =>  $start,
            'listings' => $start,
        ]);
    }
}
