<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

final class SideBar extends Component
{
    public $results = [];

    #[Url()]
    public $locations = [];

    #[Url()]
    public $propertyTypes = [];

    #[Url()]
    public string $search = '';

    #[Url()]
    public array $selectedLocations = [];

    #[Url()]
    public array $selectedTypes = [];

    public function updatedSearch(): void
    {
        $this->applyFilters();
    }

    public function updatedSelectedLocations(): void
    {
        $this->applyFilters();
    }

    public function updatedSelectedTypes(): void
    {
        $this->applyFilters();
    }

    public function mount(): void
    {
        $this->locations = Location::select('id', 'town_city')->get();
        $this->propertyTypes = PropertyType::select('id', 'type_name')->get();
        $this->applyFilters();
//        $this->results = Property::search($this->search)->get();
    }

    public function applyFilters(): void
    {
        $query = Property::query();

        if ($this->search !== '' && $this->search !== '0') {
            $query = Property::search($this->search);
        }

        if ($this->selectedLocations !== []) {
            $query->whereIn('location_id', $this->selectedLocations);
        }

        if ($this->selectedTypes !== []) {
            $query->whereIn('property_type_id', $this->selectedTypes);
        }

        if (Request::is('/')) {
            $this->results = $query->latest()->take(7)->get();
        } elseif (Request::is('properties')) {
            $this->results = $query->latest()
                ->take(30)->get();
            //                ->paginate(10);
        }
//        dd($this->results);
    }

    public function render(): View
    {
        return view('livewire.sidebar', [
            'search' => $this->search,
            'results' => $this->results,
        ]);
    }
}
