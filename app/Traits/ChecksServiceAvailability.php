<?php

namespace App\Traits;

use App\Models\ServiceAvailability;

trait ChecksServiceAvailability
{
    public bool $serviceUnavailable = false;

    public function checkServiceAvailability($serviceKey): void
    {
        $service = ServiceAvailability::where('service_key', $serviceKey)->first();

        if (!$service || !$service->is_active) $this->serviceUnavailable = true;
    }
}
