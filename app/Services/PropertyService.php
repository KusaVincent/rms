<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Property;
use App\Traits\Limitable;
use App\Traits\Paginatable;
use App\Traits\Relatable;
use App\Traits\Selectable;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

final class PropertyService
{
    use Limitable, Paginatable, Relatable, Selectable;

    public function findPropertyById(string $propertySlug): ?Property
    {
        return $this->relatedProperties($propertySlug, true);
    }

    /**
     * @return Collection<int, Property>|LengthAwarePaginator<int, Property>
     */
    public function resolveProperties(string $path, ?Property $property): Collection|LengthAwarePaginator
    {
        try {
            switch ($path) {
                case 'home':
                    return Property::select($this->selects())
                        ->isAvailable()
                        ->with($this->relations())
                        ->inRandomOrder()
                        ->take($this->limit())
                        ->get();

                case 'properties':
                    return Property::select($this->selects())
                        ->isAvailable()
                        ->with($this->relations())
                        ->orderBy('created_at', 'desc')
                        ->paginate($this->getPerPage(), pageName: 'properties-page');

                case 'details':
                    return $this->getRelatedProperties($property);

                default:
                    Log::warning("Unrecognized path: {$path}");

                    return collect();
            }
        } catch (Exception $e) {
            Log::error("Error resolving properties for path '{$path}': ".$e->getMessage(), [
                'path' => $path,
                'property' => $property,
            ]);

            return collect();
        }
    }

    /**
     * @return Collection<int, Property>
     */
    private function getRelatedProperties(?Property $property): Collection
    {
        if (! $property instanceof Property) {
            return new Collection;
        }

        try {
            /**
             * @return Builder|Builder<Property>
             */
            $query = Property::query();

            return $query
                ->select($this->selects(true))
                ->isAvailable()
                ->whereHas('propertyType', function ($query) use ($property): void {
                    $query->where('id', $property->property_type_id);
                })
                ->whereNot('id', $property->id)
                ->with($this->relations())
                ->inRandomOrder()
                ->take($this->relatedLimit())
                ->get();
        } catch (Exception $e) {
            Log::error("Failed to fetch related properties for property ID {$property->id}: {$e->getMessage()}");

            return new Collection();
        }
    }
}
