<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\ResolvePropertyClassAction;
use App\Helpers\LogHelper;
use App\Models\Property as ModelsProperty;
use App\Services\PropertyService;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
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

    private Collection|LengthAwarePaginator|null $properties = null;

    public function mount(PropertyService $propertyService, ResolvePropertyClassAction $resolveClassAction): void
    {
        $routeName = Route::currentRouteName();
        $user = auth()->user();
        $slug = Request::route('slug');

        try {
            $startMount = microtime(true);

            if ($routeName === 'details') {
                $startProperty = microtime(true);
                $this->property = $propertyService->findPropertyById($slug);
                $durationProperty = round((microtime(true) - $startProperty) * 1000, 2); // ms

                if (! $this->property instanceof ModelsProperty) {
                    LogHelper::warning(
                        message: 'Property not found.',
                        request: request(),
                        additionalData: [
                            'slug' => $slug,
                            'route' => $routeName,
                            'user_id' => $user?->id,
                            'ip' => request()->ip(),
                            'duration_ms' => $durationProperty,
                        ]
                    );

                    $this->redirectRoute('properties', navigate: true);

                    return;
                }

                LogHelper::info(
                    message: 'Property resolved successfully.',
                    request: request(),
                    additionalData: [
                        'slug' => $slug,
                        'property_id' => $this->property->id,
                        'route' => $routeName,
                        'user_id' => $user?->id,
                        'duration_ms' => $durationProperty,
                    ]
                );
            }

            $startProps = microtime(true);
            $this->class = $resolveClassAction->execute($routeName);
            $this->properties = $propertyService->resolveProperties($routeName, $this->property);
            $durationProps = round((microtime(true) - $startProps) * 1000, 2); // ms

            LogHelper::info(
                message: 'Properties loaded.',
                request: request(),
                additionalData: [
                    'route' => $routeName,
                    'properties_count' => $this->properties?->count(),
                    'user_id' => $user?->id,
                    'duration_ms' => $durationProps,
                ]
            );

            $totalMount = round((microtime(true) - $startMount) * 1000, 2);

            LogHelper::info(
                message: 'mount() completed.',
                request: request(),
                additionalData: [
                    'route' => $routeName,
                    'user_id' => $user?->id,
                    'total_duration_ms' => $totalMount,
                ]
            );

        } catch (InvalidArgumentException $e) {
            ToastMagic::error('Invalid property identifier provided.');
            LogHelper::warning(
                message: 'Invalid argument encountered.',
                request: request(),
                additionalData: [
                    'error' => $e->getMessage(),
                    'route' => $routeName,
                    'user_id' => $user?->id,
                ]
            );
            $this->redirectRoute('properties', navigate: true);

        } catch (Exception $e) {
            ToastMagic::error('Something went wrong. Please try again later.');
            LogHelper::error(
                message: 'An unexpected error occurred in mount.',
                request: request(),
                additionalData: [
                    'error' => $e->getMessage(),
                    'route' => $routeName,
                    'user_id' => $user?->id,
                ]
            );
            $this->redirectRoute('properties', navigate: true);
        }
    }

    #[On('search-results')]
    public function setSearchResults($results): void
    {
        $start = microtime(true);
        $this->searchResults = $results;
        $duration = round((microtime(true) - $start) * 1000, 2);

        LogHelper::info(
            message: 'Search results updated.',
            request: request(),
            additionalData: [
                'results_count' => count($results),
                'user_id' => auth()->id(),
                'event' => 'search-results',
                'duration_ms' => $duration,
            ]
        );
    }

    #[On('filter-results')]
    public function setFilterResults($results): void
    {
        $start = microtime(true);
        $this->filterResults = $results;
        $duration = round((microtime(true) - $start) * 1000, 2);

        LogHelper::info(
            message: 'Filter results updated.',
            request: request(),
            additionalData: [
                'results_count' => count($results),
                'user_id' => auth()->id(),
                'event' => 'filter-results',
                'duration_ms' => $duration,
            ]
        );
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
