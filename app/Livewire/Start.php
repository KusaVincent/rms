<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Property;
use App\Traits\ChecksServiceAvailability;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

final class Start extends Component
{
    use ChecksServiceAvailability;

    public string $serviceKey = 'starts';

    public function mount(): void
    {
        $this->checkServiceAvailability($this->serviceKey);
    }

    public function render(): View
    {
        if ($this->serviceUnavailable) {
            return view('livewire.empty');
        }

        $saleStart = Cache::remember('sale_start_count', now()->addMinutes(60 * 24), function () {
            return Property::count();
        });

        $agentStart = $saleStart;
        $listingStart = $saleStart;

        return view('livewire.start', [
            'sale' => $saleStart,
            'agents' => $agentStart,
            'listings' => $listingStart,
        ]);
    }
}
