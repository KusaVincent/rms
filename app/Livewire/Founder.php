<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Helpers\LogHelper;
use App\Models\Founder as ModelsFounder;
use App\Traits\ChecksServiceAvailability;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
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

        try {
            $founders = Cache::remember('founders', now()->addYear(), fn () => ModelsFounder::all());
        } catch (Exception $e) {
            LogHelper::error("Failed to fetch founders: {$e->getMessage()}");

            try {
                $founders = ModelsFounder::all();
            } catch (Exception $dbException) {
                $founders = collect();
                LogHelper::error("Failed to fetch founders from the database: {$dbException->getMessage()}");
            }
        }

        return view('livewire.founder', [
            'founders' => $founders,
        ]);
    }
}
