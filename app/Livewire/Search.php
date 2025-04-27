<?php

namespace App\Livewire;

use App\Models\Property;
use App\Traits\Paginatable;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;

class Search extends Component
{
    use Paginatable;

    #[Url()]
    public string $search = '';
    public Collection $results;

    public function updatedSearch(): void
    {
        $this->results = collect();

        if ($this->search !== '' && $this->search !== '0')
            $this->results = Property::whereIn('id',
                Property::search($this->search)->get()->pluck('id')
            )->with(['location', 'amenities', 'propertyType'])
                ->get()
//                ->paginate($this->getPerPage(), pageName: 'search-page')
            ;

        $this->dispatch('search-results', $this->results);
    }
}
