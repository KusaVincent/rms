<?php

declare(strict_types=1);

namespace App\Traits;

use App\Helpers\LogHelper;
use App\Models\ServiceAvailability;
use Illuminate\Support\Facades\Cache;
use Throwable;

trait ChecksServiceAvailability
{
    public bool $serviceUnavailable = false;

    public function checkServiceAvailability(string $serviceKey): void
    {
        $sessionId = session()->getId();
        $user = auth()->user();

        try {
            $service = Cache::remember(
                "{$serviceKey}_service_availability",
                now()->addMinutes(5),
                fn () => ServiceAvailability::where('service_key', $serviceKey)->first()
            );

            $this->serviceUnavailable = ! ($service && $service->is_active->value);

            LogHelper::success(
                message: "Checked service availability for '{$serviceKey}'.",
                request: request(),
                additionalData: [
                    'component' => class_basename($this),
                    'user_id' => $user?->id,
                    'user_email' => $user?->email,
                    'session_id' => $sessionId,
                    'service_key' => $serviceKey,
                    'is_available' => ! $this->serviceUnavailable,
                    'cached' => true,
                ]
            );
        } catch (Throwable $e) {
            $this->serviceUnavailable = true;

            LogHelper::exception(
                $e,
                request: request(),
                additionalData: [
                    'component' => class_basename($this),
                    'user_id' => $user?->id,
                    'user_email' => $user?->email,
                    'session_id' => $sessionId,
                    'service_key' => $serviceKey,
                    'cached' => false,
                ]
            );
        }
    }
}
