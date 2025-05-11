<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait Selectable
{
    public bool $isCalledFromDetail = false;

    /**
     * @return array<string>
     */
    public function selects(bool $created_at = false): array
    {
        try {
            $selects = ['id', 'name', 'rent', 'property_image', 'location_id', 'property_type_id', 'negotiable'];

            if ($created_at) {
                $selects[] = 'created_at';
            }

            if ($this->isCalledFromDetail) {
                $selects[] = 'description';
            }

            return $selects;
        } catch (\Exception $e) {
            Log::error('Error in selects method: ' . $e->getMessage());
            return ['*'];
        }
    }

    /**
     * @return array<string>
     */
    public function relations(bool $includeAmenities = false): array
    {
        try {
            if ($this->isCalledFromDetail) {
                return [
                    'location:id,town_city,area,address,map',
                    'amenities:id,amenity_name,amenity_icon,amenity_icon_color,amenity_description',
                    'propertyMedia:id,property_id,image_one,image_two,image_three,image_four,image_five,video',
                ];
            }

            $relations = [
                'location:id,town_city,area',
                'propertyType:id,type_name',
            ];

            if ($includeAmenities) {
                $relations[] = 'amenities:id,amenity_name';
            }

            return $relations;
        } catch (\Exception $e) {
            Log::error('Error in selects method: ' . $e->getMessage());
            return [];
        }
    }
}
