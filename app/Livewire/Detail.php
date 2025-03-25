<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Property;
use Illuminate\View\View;

class Detail extends Component
{
    public Property $property;

    public function mount(int $id): void
    {
        $this->property = Property::findOrFail($id);
    }

    public function render(): View
    {
        return view('livewire.detail')
            ->layout('tenant-entry');
    }
}
