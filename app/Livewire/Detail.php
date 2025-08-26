<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Property;
use App\Traits\Relatable;
use App\Traits\Selectable;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

final class Detail extends Component
{
    use Relatable, Selectable;

    public Property $property;

    public function mount(string $slug): void
    {
        $this->isCalledFromDetail = true;

        try {
            $this->property = $this->relatedProperties($slug);
        } catch (ModelNotFoundException $e) {

            Log::error("Property with ID {$slug} not found: ".$e->getMessage());
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
