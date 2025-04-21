<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use App\Models\About as ModelsAbout;

final class About extends Component
{
    public function render(): View
    {
        return view('livewire.about', [
            'abouts' => ModelsAbout::all(),
        ]);
    }
}
