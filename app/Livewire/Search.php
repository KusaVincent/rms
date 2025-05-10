<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Property;
use App\Traits\Limitable;
use App\Traits\Selectable;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Url;
use Livewire\Component;

final class Search extends Component
{
    use Limitable, Selectable;

    #[Url(except: '')]
    public string $search = '';

    public Collection $results;

    public function updatedSearch(): void
    {
        $this->results = new Collection();

        if ($this->search === '') {
            $this->redirectRoute('properties', navigate: true);

            return;
        }

        try {
            $this->results = Property::select($this->selects())
                ->isAvailable()
                ->whereIn('id', Property::search($this->search)->get()->pluck('id'))
                ->with($this->relations())
                ->take($this->limit())
                ->get();

            $this->dispatch('search-results', $this->results);
        } catch (Exception $e) {
            $this->results = new Collection();
            ToastMagic::error('An error occurred while searching. Please try again.');
            Log::error("Search failed for query '{$this->search}': {$e->getMessage()}");
        }
    }
}
