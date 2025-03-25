<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class RentRange extends Component
{
    public int $minPrice = 82; // Minimum price
    public int $maxPrice = 68350; // Maximum price
    public int $selectedMinPrice = 17590; // Initial selected minimum
    public int $selectedMaxPrice = 57904; // Initial selected maximum


    public function render(): View
    {
        return view('livewire.rent-range');
    }
}
