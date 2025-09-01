<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\LogHelper;
use App\Models\Property;
use App\Traits\Limitable;
use App\Traits\Paginatable;
use App\Traits\Relatable;
use App\Traits\Selectable;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class PropertyService
{
    use Limitable, Paginatable, Relatable, Selectable;

    public function findPropertyById(string $propertySlug): ?Property
    {
        try {
            $property = $this->relatedProperties($propertySlug, true);

            LogHelper::success(
                message: 'Property found by slug.',
                request: request(),
                additionalData: [
                    'component' => 'PropertyService',
                    'method' => 'findPropertyById',
                    'slug' => $propertySlug,
                    'property_id' => $property?->id,
                    'user_id' => auth()->id(),
                ]
            );

            return $property;
        } catch (Exception $e) {
            LogHelper::exception(
                $e,
                status: 404,
                request: request(),
                additionalData: [
                    'component' => 'PropertyService',
                    'method' => 'findPropertyById',
                    'slug' => $propertySlug,
                    'user_id' => auth()->id(),
                ]
            );

            return null;
        }
    }

    /**
     * @return Collection<int, Property>|LengthAwarePaginator<int, Property>
     */
    public function resolveProperties(string $path, ?Property $property): Collection|LengthAwarePaginator
    {
        $start = microtime(true);

        try {
            $result = match ($path) {
                'home' => Property::select($this->selects())
                    ->isAvailable()
                    ->with($this->relations())
                    ->inRandomOrder()
                    ->take($this->limit())
                    ->get(),

                'properties' => Property::select($this->selects())
                    ->isAvailable()
                    ->with($this->relations())
                    ->orderBy('created_at', 'desc')
                    ->paginate($this->getPerPage(), pageName: 'properties-page'),

                'details' => $this->getRelatedProperties($property),

                default => collect()
            };

            $duration = round((microtime(true) - $start) * 1000, 2);

            LogHelper::success(
                message: 'Properties resolved successfully.',
                request: request(),
                additionalData: [
                    'component' => 'PropertyService',
                    'method' => 'resolveProperties',
                    'path' => $path,
                    'user_id' => auth()->id(),
                    'user_email' => auth()->user()?->email,
                    'duration_ms' => $duration,
                    'result_count' => $result instanceof Collection ? $result->count() : $result->total(),
                    'property_id' => $property?->id,
                ]
            );

            return $result;
        } catch (Exception $e) {
            LogHelper::exception(
                $e,
                request: request(),
                additionalData: [
                    'component' => 'PropertyService',
                    'method' => 'resolveProperties',
                    'path' => $path,
                    'user_id' => auth()->id(),
                    'property_id' => $property?->id,
                ]
            );

            return collect();
        }
    }

    /**
     * @return Collection<int, Property>
     */
    private function getRelatedProperties(?Property $property): Collection
    {
        if (! $property instanceof Property) {
            LogHelper::info(
                message: 'No property provided to fetch related properties.',
                request: request(),
                additionalData: [
                    'component' => 'PropertyService',
                    'method' => 'getRelatedProperties',
                ]
            );

            return collect();
        }

        try {
            $start = microtime(true);

            $query = Property::query();

            $related = $query
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

            $duration = round((microtime(true) - $start) * 1000, 2);

            LogHelper::success(
                message: 'Related properties fetched.',
                request: request(),
                additionalData: [
                    'component' => 'PropertyService',
                    'method' => 'getRelatedProperties',
                    'property_id' => $property->id,
                    'user_id' => auth()->id(),
                    'related_count' => $related->count(),
                    'duration_ms' => $duration,
                ]
            );

            return $related;
        } catch (Exception $e) {
            LogHelper::exception(
                $e,
                status: 500,
                request: request(),
                additionalData: [
                    'component' => 'PropertyService',
                    'method' => 'getRelatedProperties',
                    'property_id' => $property->id ?? null,
                    'user_id' => auth()->id(),
                ]
            );

            return collect();
        }
    }
}
