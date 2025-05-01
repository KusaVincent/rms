<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Property;
use App\Traits\Limitable;
use App\Traits\Paginatable;
use App\Traits\Selectable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

final class PropertyService
{
    use Limitable, Paginatable, Selectable;

    public function findPropertyByRequestUrl(string $url): Property
    {
        preg_match('/\/property-details\/(\d+)/', $url, $matches);

        $propertyId = $matches[1] ?? null;

        return $propertyId !== null && $propertyId !== '0'
            ? Property::with(['location', 'amenities', 'propertyType'])->findOrFail($propertyId)
            : new Property;
    }

    /**
     * @return Collection<int, Property>|LengthAwarePaginator<int, Property>
     */
    public function resolveProperties(string $path, ?Property $property): Collection|LengthAwarePaginator
    {
        if ($path === '/') {
            return Property::select($this->selects())
                ->with($this->relations())
                ->orderBy('created_at', 'desc')
                ->take($this->limit())
                ->get();
        }

        if ($path === 'properties') {
            return Property::select($this->selects())
                ->with($this->relations())
                ->orderBy('created_at', 'desc')
                ->paginate($this->getPerPage(), pageName: 'properties-page');
        }

        if (str_starts_with($path, 'property-details/')) {
            return $this->getRelatedProperties($property);
        }

        return new Collection;
    }

    /**
     * @return Collection<int, Property>
     */
    private function getRelatedProperties(?Property $property): Collection
    {
        if (! $property instanceof Property) {
            return new Collection;
        }
        /**
         * @return Builder|Builder<Property>
         */
        $query = Property::query();

        return $query
            ->select($this->selects(true))
            ->whereHas('propertyType', function ($query) use ($property): void {
                $query->where('id', $property->property_type_id);
            })
            ->where('id', '!=', $property->id)
            ->with($this->relations())
            ->inRandomOrder()
            ->take($this->relatedLimit())
            ->get();
    }
}
