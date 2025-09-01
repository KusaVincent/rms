<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\PropertyNegotiable;
use App\Helpers\LogHelper;
use App\Models\Property;
use App\Traits\Limitable;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

final class PropertyFilterAction
{
    use Limitable;

    public static function execute(array $criteria): Collection
    {
        $sessionId = session()->getId();
        $user = auth()->user();

        $filters = [
            'search' => Cache::get("search_{$sessionId}"),
            'types' => Cache::get("filter_types_{$sessionId}"),
            'locations' => Cache::get("filter_locations_{$sessionId}"),
            'negotiable' => Cache::get("filter_negotiable_{$sessionId}"),
        ];

        $selects = $criteria['selects'] ?? ['*'];
        $relations = $criteria['relations'] ?? [];
        $limit = $criteria['limit'] ?? self::DEFAULT_LIMIT;

        $start = microtime(true);

        try {
            $query = Property::query()->select($selects)->isAvailable();

            if (! empty($filters['search'])) {
                $query->whereIn('id', Property::search($filters['search'])->keys());
            }

            if ($filters['negotiable'] === 'Yes') {
                $query->where('negotiable', PropertyNegotiable::YES);
            }

            if (! empty($filters['locations'])) {
                $query->whereIn('location_id', $filters['locations']);
            }

            if (! empty($filters['types'])) {
                $query->whereIn('property_type_id', $filters['types']);
            }

            $results = $query->with($relations)->latest()->take($limit)->get();

            LogHelper::success(
                message: 'Property filters applied successfully.',
                request: request(),
                additionalData: [
                    'component' => 'PropertyFilterAction',
                    'duration_ms' => round((microtime(true) - $start) * 1000, 2),
                    'user_id' => $user?->id,
                    'user_email' => $user?->email,
                    'filters' => array_filter($filters),
                    'criteria' => $criteria,
                    'results_count' => $results->count(),
                    'session_id' => $sessionId,
                ]
            );

            return $results;
        } catch (Exception $e) {
            LogHelper::exception(
                $e,
                request: request(),
                additionalData: [
                    'component' => 'PropertyFilterAction',
                    'user_id' => $user?->id,
                    'filters' => array_filter($filters),
                    'criteria' => $criteria,
                    'session_id' => $sessionId,
                ]
            );

            return collect();
        }
    }
}
