<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Helpers\LogHelper;
use App\Models\Founder as ModelsFounder;
use App\Traits\ChecksServiceAvailability;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

final class Founder extends Component
{
    use ChecksServiceAvailability;

    public string $serviceKey = 'meet_the_team';

    public function mount(): void
    {
        $this->checkServiceAvailability($this->serviceKey);
    }

    public function render(): View
    {
        if ($this->serviceUnavailable) {
            return view('livewire.empty');
        }

        $sessionId = session()->getId();
        $user = auth()->user();

        $start = microtime(true);

        try {
            $founders = Cache::remember('founders', now()->addYear(), fn () => ModelsFounder::all());

            $duration = round((microtime(true) - $start) * 1000, 2);

            LogHelper::success(
                message: 'Fetched founders successfully (from cache).',
                request: request(),
                additionalData: [
                    'component' => 'Founder Livewire Component',
                    'duration_ms' => $duration,
                    'user_id' => $user?->id,
                    'user_email' => $user?->email,
                    'session_id' => $sessionId,
                    'cached' => true,
                    'founders_count' => $founders->count(),
                ]
            );
        } catch (Exception $e) {
            LogHelper::exception(
                $e,
                request: request(),
                additionalData: [
                    'component' => 'Founder Livewire Component',
                    'user_id' => $user?->id,
                    'user_email' => $user?->email,
                    'session_id' => $sessionId,
                    'cached' => true,
                ]
            );

            try {
                $founders = ModelsFounder::all();

                $duration = round((microtime(true) - $start) * 1000, 2);

                LogHelper::success(
                    message: 'Fetched founders successfully (from DB fallback).',
                    request: request(),
                    additionalData: [
                        'component' => 'Founder Livewire Component',
                        'duration_ms' => $duration,
                        'user_id' => $user?->id,
                        'user_email' => $user?->email,
                        'session_id' => $sessionId,
                        'cached' => false,
                        'founders_count' => $founders->count(),
                    ]
                );
            } catch (Exception $dbException) {
                $founders = collect();

                LogHelper::exception(
                    $dbException,
                    request: request(),
                    additionalData: [
                        'component' => 'Founder Livewire Component',
                        'user_id' => $user?->id,
                        'user_email' => $user?->email,
                        'session_id' => $sessionId,
                        'cached' => false,
                    ]
                );
            }
        }

        return view('livewire.founder', [
            'founders' => $founders,
        ]);
    }
}
