<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\ResolvePropertyClassAction;
use App\Models\Property as ModelsProperty;
use App\Services\PropertyService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\On;
use Livewire\Component;

final class Property extends Component
{
    public string $class;

    public ?ModelsProperty $property = null;

    private $searchResults;

    private $filterResults;

    /**
     * @returns LengthAwarePaginator<int, ModelsProperty>
     * */
    private Collection|LengthAwarePaginator|null $properties = null;

    public function mount(PropertyService $propertyService, ResolvePropertyClassAction $resolveClassAction): void
    {
        $propertyService1 = $propertyService;
        $resolveClassAction1 = $resolveClassAction;

        if (Route::currentRouteName() === 'details') {
            $id = Request::route('id');
            $this->property = $propertyService1->findPropertyById($id);
        }

        $this->class = $resolveClassAction1->execute(Route::currentRouteName());

        $this->properties = $propertyService1->resolveProperties(Route::currentRouteName(), $this->property);
    }

    #[On('search-results')]
    public function setSearchResults($results): void
    {
        $this->searchResults = $results;
    }

    #[On('filter-results')]
    public function setFilterResults($results): void
    {
        $this->filterResults = $results;
    }

    public function render(): View
    {
        return view('livewire.property', [
            'properties' => $this->properties,
            'filterResults' => $this->filterResults,
            'searchResults' => $this->searchResults,
        ])->layout('tenant-entry');
    }
}
