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
    public array $selectedLocations = [];

    #[Url()]
    public array $selectedTypes = [];

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
    }

    public function render(): View
    {
        return view('livewire.sidebar', [
            'results' => $this->results,
        ]);
    }
}
