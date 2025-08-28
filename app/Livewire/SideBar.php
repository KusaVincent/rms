<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\PropertyFilterAction;
use App\Helpers\LogHelper;
use App\Models\Location;
use App\Models\PropertyType;
use App\Traits\Limitable;
use App\Traits\Selectable;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

final class SideBar extends Component
{
    use Limitable, Selectable;

    public $negotiable = '';

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
            LogHelper::error("Error fetching locations or property types: {$e->getMessage()}");
        }
    }

    public function updatedNegotiable(): void
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

    public function applyFilters(): void
    {
        Cache::forget('filter_types_'.session()->getId());
        Cache::forget('filter_locations_'.session()->getId());
        Cache::forget('filter_negotiable_'.session()->getId());

        $criteria = [
            'limit' => $this->limit(),
            'selects' => $this->selects(),
            'relations' => $this->relations(),
        ];

        try {
            if ($this->negotiable === 'Yes') {
                Cache::set('filter_negotiable_'.session()->getId(), $this->negotiable, now()->addMinutes(5));
            }

            if ($this->selectedLocations !== []) {
                Cache::set('filter_locations_'.session()->getId(), $this->selectedLocations, now()->addMinutes(5));
            }

            if ($this->selectedTypes !== []) {
                Cache::set('filter_types_'.session()->getId(), $this->selectedTypes, now()->addMinutes(5));
            }

            $this->results = PropertyFilterAction::execute($criteria);

            LogHelper::info('Filter Result For Successful');

            $this->dispatch('filter-results', $this->results);
        } catch (Exception $e) {
            $this->results = collect();
            LogHelper::error("Error applying filters: {$e->getMessage()}");
            ToastMagic::error('Failed to apply filters. Please try again later.');
        }
    }
}
