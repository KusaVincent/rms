<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Services\PropertyService;
use Illuminate\Support\Facades\Request;
use App\Models\Property as PropertyModel;
use App\Actions\ResolvePropertyClassAction;

class Property extends Component
{
    public string $class;
    protected $properties;
    public ?PropertyModel $property = null;
    protected PropertyService $propertyService;
    protected ResolvePropertyClassAction $resolveClassAction;

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
