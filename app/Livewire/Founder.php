<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;
use App\Models\Founder as ModelsFounder;

final class Founder extends Component
{
    public function render()
    {
        $founders = ModelsFounder::all();

        return view('livewire.founder', [
            'founders' => $founders,
        ]);
    }
}
