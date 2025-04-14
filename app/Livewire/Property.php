<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\ResolvePropertyClassAction;
use App\Models\Property as PropertyModel;
use App\Services\PropertyService;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;
use Livewire\Component;

final class Property extends Component
{
    public string $class;

    public ?PropertyModel $property = null;

    private \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator|null $properties = null;

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

    public function render(): View
    {
        return view('livewire.property', [
            'properties' => $this->properties,
        ])->layout('tenant-entry');
    }
}
