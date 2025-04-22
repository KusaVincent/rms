<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Traits\ChecksServiceAvailability;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Models\Founder as ModelsFounder;

final class Founder extends Component
{
    use ChecksServiceAvailability;

    public string $serviceKey = 'meet_the_team';

    public function mount(): void
    {
        $this->checkServiceAvailability($this->serviceKey);
    }

    public function render() : View
    {
        if ($this->serviceUnavailable) return view('livewire.empty');

        $founders = ModelsFounder::all();

        return view('livewire.founder', [
            'founders' => $founders,
        ]);
    }
}
