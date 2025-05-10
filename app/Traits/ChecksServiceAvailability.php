<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\ServiceAvailability;
use Illuminate\Support\Facades\Cache;

trait ChecksServiceAvailability
{
    public bool $serviceUnavailable = false;

    public function checkServiceAvailability(string $serviceKey): void
    {
        $service = Cache::remember($serviceKey.'_service_availability', now()->addMinutes(5), fn () => ServiceAvailability::where('service_key', $serviceKey)->first());

        if (! $service || ! $service->is_active) {
            $this->serviceUnavailable = true;
        }
    }
}
