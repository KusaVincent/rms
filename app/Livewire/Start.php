<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Helpers\LogHelper;
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
            $agentStart = Cache::remember(
                'agent_start_count',
                now()->addDay(),
                fn () => Property::count()
            );
            $listingStart = Cache::remember(
                'listing_start_count',
                now()->addDay(),
                fn () => Property::count()
            );
        } catch (Exception $e) {
            LogHelper::error('Error fetching property count: '.$e->getMessage());
            $saleStart = 0;
            $agentStart = 0;
            $listingStart = 0;
        }

        return view('livewire.start', [
            'sales' => $saleStart,
            'agents' => $agentStart,
            'listings' => $listingStart,
        ]);
    }
}
