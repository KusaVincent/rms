<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Helpers\LogHelper;
use App\Models\Property;
use App\Traits\Relatable;
use App\Traits\Selectable;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

            LogHelper::success(
                message: 'Property fetched successfully.',
                status: 200,
                request: request(),
                additionalData: [
                    'slug' => $slug,
                    'property_id' => $this->property->id,
                    'component' => 'Detail',
                ]
            );
        } catch (ModelNotFoundException $e) {
            LogHelper::exception(
                $e,
                status: 404,
                request: request(),
                additionalData: [
                    'slug' => $slug,
                    'component' => 'Detail',
                ]
            );

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
