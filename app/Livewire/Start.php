<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Helpers\LogHelper;
use App\Models\Property;
use App\Traits\ChecksServiceAvailability;
use Exception;
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
            LogHelper::info(
                message: 'Service unavailable on Start component.',
                request: request(),
                additionalData: [
                    'component' => 'Start',
                    'service_key' => $this->serviceKey,
                    'user_id' => auth()->id(),
                ]
            );

            return view('livewire.empty');
        }

        $start = microtime(true);
        $user = auth()->user();

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

            $duration = round((microtime(true) - $start) * 1000, 2);

            LogHelper::success(
                message: 'Start component metrics fetched successfully.',
                request: request(),
                additionalData: [
                    'component' => 'Start',
                    'user_id' => $user?->id,
                    'user_email' => $user?->email,
                    'duration_ms' => $duration,
                    'metrics' => [
                        'sales' => $saleStart,
                        'agents' => $agentStart,
                        'listings' => $listingStart,
                    ],
                ]
            );
        } catch (Exception $e) {
            LogHelper::exception(
                $e,
                status: 500,
                request: request(),
                additionalData: [
                    'component' => 'Start',
                    'user_id' => $user?->id,
                    'user_email' => $user?->email,
                ]
            );

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
