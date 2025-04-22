<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Traits\ChecksServiceAvailability;
use Illuminate\View\View;
use Livewire\Component;
use App\Models\Property;

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
        if ($this->serviceUnavailable) return view('livewire.empty');

        $saleStart = $agentStart = $listingStart = Property::count();

        return view('livewire.start', [
            'sale' => $saleStart,
            'agents' =>  $agentStart,
            'listings' => $listingStart,
        ]);
    }
}
