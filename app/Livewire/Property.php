<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\ResolvePropertyClassAction;
use App\Models\Property as ModelsProperty;
use App\Services\PropertyService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

final class Property extends Component
{
    public string $class;

    public ?ModelsProperty $property = null;

    private Collection|LengthAwarePaginator|null $properties = null;

    private $searchResults;

    private PropertyService $propertyService;

    private ResolvePropertyClassAction $resolveClassAction;

    public function mount(PropertyService $propertyService, ResolvePropertyClassAction $resolveClassAction): void
    {
        $this->propertyService = $propertyService;
        $this->resolveClassAction = $resolveClassAction;

        if (Request::is('property-details/*')) {
            $this->property = $this->propertyService->findPropertyByRequestUrl(Request::url());
        }

        $this->class = $this->resolveClassAction->execute(Request::path());

        $this->properties = $this->propertyService->resolveProperties(Request::path(), $this->property);
    }

    #[On('search-results')]
    public function setSearchResults($results): void
    {
        $this->searchResults = $results;
    }

    public function render(): View
    {
        return view('livewire.property', [
            'properties' => $this->properties,
            'searchResults' => $this->searchResults,
        ])->layout('tenant-entry');
    }
}
