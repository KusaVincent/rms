<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Collection;

class PropertyService
{
    use WithPagination;
    public function findPropertyByRequestUrl(string $url): ?Property
    {
        preg_match('/\/property-details\/(\d+)/', $url, $matches);

        $propertyId = $matches[1] ?? null;

        return $propertyId ? Property::with(['location', 'amenities'])->findOrFail($propertyId) : null;
    }

    public function resolveProperties(string $path, ?Property $property): Collection|LengthAwarePaginator|Property|null
    {
        if ('/' === $path) {
            return Property::with(['location', 'amenities'])
                ->orderBy('created_at', 'desc')
                ->take(15)
                ->get();
        }

        if ('properties' === $path) {
            return Property::with(['location', 'amenities'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        if (str_starts_with($path, 'property-details/')) {
            return $this->getRelatedProperties($property);
        }

        return null;
    }

    private function getRelatedProperties(?Property $property): Collection | Property | null
    {
        if (!$property) return null;

        return Property::whereHas('propertyType', function ($query) use ($property) {
            $query->where('id', $property->property_type_id);
        })
            ->where('id', '!=', $property->id)
            ->with(['location', 'amenities', 'propertyType'])
            ->inRandomOrder()
            ->take(5)
            ->get();
    }
}
