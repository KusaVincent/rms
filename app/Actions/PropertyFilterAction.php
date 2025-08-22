<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Property;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

final class PropertyFilterAction
{
    public static function execute(array $criteria): Collection
    {
        $search = Cache::get('search_'.session()->getId());
        $types = Cache::get('filter_types_'.session()->getId());
        $locations = Cache::get('filter_locations_'.session()->getId());
        $negotiable = Cache::get('filter_negotiable_'.session()->getId());

        $query = Property::query()
            ->select($criteria['selects'])
            ->isAvailable();

        if (! empty($search)) {
            $query->whereIn('id', Property::search($search)->get()->pluck('id'));
        }

        if (! empty($negotiable) && $negotiable === 'Yes') {
            $query->where('negotiable', 1);
        }

        if (! empty($locations)) {
            $query->whereIn('location_id', $locations);
        }

        if (! empty($types)) {
            $query->whereIn('property_type_id', $types);
        }

        return $query->with($criteria['relations'])
            ->latest()
            ->take($criteria['limit'] ?? 10)
            ->get();
    }
}
