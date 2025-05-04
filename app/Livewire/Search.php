<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Property;
use App\Traits\Limitable;
use App\Traits\Selectable;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;

final class Search extends Component
{
    use Limitable, Selectable;

    #[Url()]
    public string $search = '';

    public Collection $results;

    public function updatedSearch(): void
    {
        $this->results = new Collection();

        if ($this->search !== '' && $this->search !== '0') {
            $this->results = Property::select($this->selects())
                ->available()
                ->whereIn('id', Property::search($this->search)->get()->pluck('id'))
                ->with($this->relations())
                ->take($this->limit())
                ->get();
        }

        $this->dispatch('search-results', $this->results);
    }
}
