<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Property;
use Illuminate\View\View;
use Livewire\Component;

final class Detail extends Component
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
