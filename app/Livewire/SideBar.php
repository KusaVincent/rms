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

    public Collection $locations;

    public Collection $propertyTypes;

    public Collection $results;

    public array $selectedTypes = [];

    public array $selectedLocations = [];

    public function mount(): void
    {
        try {
            $this->locations = Location::select('id', 'town_city')->get();
            $this->propertyTypes = PropertyType::select('id', 'type_name')->get();

            LogHelper::success(
                message: 'Sidebar filters loaded successfully.',
                request: request(),
                additionalData: [
                    'component' => 'SideBar',
                    'user_id' => auth()->id(),
                ]
            );
        } catch (Exception $e) {
            $this->locations = collect();
            $this->propertyTypes = collect();

            LogHelper::exception(
                $e,
                request: request(),
                additionalData: [
                    'component' => 'SideBar',
                    'message' => 'Failed to load filter data',
                ]
            );

            ToastMagic::error('Failed to load data. Please try again later.');
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
        $sessionId = session()->getId();
        $user = auth()->user();

        Cache::forget('filter_types_'.$sessionId);
        Cache::forget('filter_locations_'.$sessionId);
        Cache::forget('filter_negotiable_'.$sessionId);

        $criteria = [
            'limit' => $this->limit(),
            'selects' => $this->selects(),
            'relations' => $this->relations(),
        ];

        try {
            if ($this->negotiable === 'Yes') {
                Cache::set('filter_negotiable_'.$sessionId, $this->negotiable, now()->addMinutes(5));
            }

            if (! empty($this->selectedLocations)) {
                Cache::set('filter_locations_'.$sessionId, $this->selectedLocations, now()->addMinutes(5));
            }

            if (! empty($this->selectedTypes)) {
                Cache::set('filter_types_'.$sessionId, $this->selectedTypes, now()->addMinutes(5));
            }

            $start = microtime(true);

            $this->results = PropertyFilterAction::execute($criteria);

            $duration = round((microtime(true) - $start) * 1000, 2);

            LogHelper::success(
                message: 'Filters applied successfully.',
                request: request(),
                additionalData: [
                    'component' => 'SideBar',
                    'duration_ms' => $duration,
                    'user_id' => $user?->id,
                    'user_email' => $user?->email,
                    'negotiable' => $this->negotiable,
                    'selected_types' => $this->selectedTypes,
                    'selected_locations' => $this->selectedLocations,
                    'results_count' => $this->results->count(),
                    'session_id' => $sessionId,
                ]
            );

            $this->dispatch('filter-results', $this->results);
        } catch (Exception $e) {
            $this->results = collect();

            LogHelper::exception(
                $e,
                request: request(),
                additionalData: [
                    'component' => 'SideBar',
                    'user_id' => $user?->id,
                    'negotiable' => $this->negotiable,
                    'selected_types' => $this->selectedTypes,
                    'selected_locations' => $this->selectedLocations,
                    'session_id' => $sessionId,
                ]
            );

            ToastMagic::error('Failed to apply filters. Please try again later.');
        }
    }
}
