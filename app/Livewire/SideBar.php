<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyType;
use App\Traits\Limitable;
use App\Traits\Selectable;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

final class SideBar extends Component
{
    use Limitable, Selectable;

    public $locations = [];

    public $propertyTypes = [];

    public Collection $results;

    public array $selectedTypes = [];

    public array $selectedLocations = [];

    public function mount(): void
    {
        try {
            $this->locations = Location::select('id', 'town_city')->get();
            $this->propertyTypes = PropertyType::select('id', 'type_name')->get();
        } catch (Exception $e) {
            $this->locations = [];
            $this->propertyTypes = [];
            ToastMagic::error('Failed to load data. Please try again later.');
            Log::error("Error fetching locations or property types: {$e->getMessage()}");
        }
    }

    public function updateSelectedLocations(): void
    {
        $this->applyFilters();
    }

    public function updateSelectedTypes(): void
    {
        $this->applyFilters();
    }

    public function applyFilters(): void
    {
        try {
            $query = Property::query();
            $query->select($this->selects())
                ->isAvailable();

            if ($this->selectedLocations !== []) {
                $query->whereIn('location_id', $this->selectedLocations);
            }

            if ($this->selectedTypes !== []) {
                $query->whereIn('property_type_id', $this->selectedTypes);
            }

            $this->results = $query->with($this->relations())
                ->latest()
                ->take($this->limit())
                ->get();

            $this->dispatch('filter-results', $this->results);
        } catch (Exception $e) {
            $this->results = collect();
            Log::error("Error applying filters: {$e->getMessage()}");
            ToastMagic::error('Failed to apply filters. Please try again later.');
        }
    }
}
