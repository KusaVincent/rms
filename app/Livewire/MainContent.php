<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class MainContent extends Component
{
    public function render():View
    {
        return view('livewire.main-content');
    }
}
