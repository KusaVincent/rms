<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Property;
use App\Traits\ChecksServiceAvailability;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
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

        try {
            $saleStart = Cache::remember(
                'sale_start_count',
                now()->addDay(),
                fn () => Property::count()
            );
        } catch (Exception $e) {
            Log::error('Error fetching property count: '.$e->getMessage());
            $saleStart = 0;
        }

        $agentStart = $saleStart;
        $listingStart = $saleStart;

        return view('livewire.start', [
            'sale' => $saleStart,
            'agents' => $agentStart,
            'listings' => $listingStart,
        ]);
    }
}
