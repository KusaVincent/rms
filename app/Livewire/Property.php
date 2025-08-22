<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\ResolvePropertyClassAction;
use App\Models\Property as ModelsProperty;
use App\Services\PropertyService;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use InvalidArgumentException;
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
        $routeName = Route::currentRouteName();

        try {
            $propertyService1 = $propertyService;
            $resolveClassAction1 = $resolveClassAction;

            if ($routeName === 'details') {
                $id = Request::route('id');

                if (! is_numeric($id) || (int) $id <= 0) {
                    throw new InvalidArgumentException("Invalid property ID provided: {$id}");
                }

                $id = (int) $id;
                $this->property = $propertyService1->findPropertyById($id);

                if (! $this->property instanceof ModelsProperty) {
                    Log::warning("Property not found for ID: {$id}");
                    $this->redirectRoute($routeName, navigate: true);
                }
            }

            $this->class = $resolveClassAction1->execute($routeName);
            $this->properties = $propertyService1->resolveProperties($routeName, $this->property);
        } catch (InvalidArgumentException $e) {
            ToastMagic::error('Invalid property identifier provided.');
            Log::warning('Invalid argument encountered: '.$e->getMessage());
            $this->redirectRoute($routeName, navigate: true);
        } catch (Exception $e) {
            Log::error('An error occurred in mount: '.$e->getMessage());
            ToastMagic::error('Something went wrong. Please try again later.');
            $this->redirectRoute($routeName, navigate: true);
        }
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
