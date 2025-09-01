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
use Log;

final class Detail extends Component
{
    use Relatable, Selectable;

    public Property $property;

    public function mount(string $slug): void
    {
        $this->isCalledFromDetail = true;

        try {
            $start = microtime(true);

            $this->property = $this->relatedProperties($slug);

            $duration = round((microtime(true) - $start) * 1000, 2);
            $user = auth()->user();

            LogHelper::success(
                message: 'Property fetched successfully.',
                request: request(),
                additionalData: [
                    'slug' => $slug,
                    'property_id' => $this->property->id,
                    'component' => 'Detail',
                    'duration_ms' => $duration,
                    'user_id' => $user?->id,
                    'user_email' => $user?->email,
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
