<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Property;
use App\Traits\Selectable;
use Illuminate\View\View;
use Livewire\Component;

final class Detail extends Component
{
    use Selectable;

    public Property $property;

    public function mount(int $id): void
    {
        $this->isCalledFromDetail = true;

        $this->property = Property::select($this->selects())
            ->with($this->relations())
            ->findOrFail($id);
    }

    public function render(): View
    {
        return view('livewire.detail')
            ->layout('tenant-entry');
    }
}
