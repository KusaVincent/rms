<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Property;
use App\Traits\Selectable;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

final class Detail extends Component
{
    use Selectable;

    public Property $property;

    public function mount($id): void
    {
        $this->isCalledFromDetail = true;

        if (! is_numeric($id) || (int) $id <= 0) {
            Log::error("Invalid property ID: {$id}");
            ToastMagic::error('Invalid property identifier provided.');
            $this->redirectRoute('properties', navigate: true);

            return;
        }

        $id = (int) $id;

        try {
            $this->property = Property::select($this->selects())
                ->isAvailable()
                ->with($this->relations())
                ->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Log::error("Property with ID {$id} not found: ".$e->getMessage());
            ToastMagic::info('Property not found. You can check more properties below');
            $this->redirectRoute('properties', navigate: true);
        }

    }

    public function render(): View
    {
        return view('livewire.detail')
            ->layout('tenant-entry');
    }
}
