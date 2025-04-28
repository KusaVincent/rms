<?php

declare(strict_types=1);

namespace App\Traits;

trait Selectable
{
    public bool $isCalledFromDetail = false;

    public function selects(bool $created_at = false): array
    {
        $selects = ['id', 'property_name', 'rent', 'property_image', 'location_id', 'property_type_id'];

        if ($created_at) {
            $selects[] = 'created_at';
        }

        if ($this->isCalledFromDetail) {
            $selects[] = 'description';
        }

        return $selects;
    }

    public function relations(bool $includeAmenities = false): array
    {
        $relations = [
            'location:id,town_city,area',
            'propertyType:id,type_name',
        ];

        if ($includeAmenities) {
            $relations[] = 'amenities:id,amenity_name';
        }

        if ($this->isCalledFromDetail) {
            return array_merge($relations, [
                'location:id,address,town_city,area,map',
                'amenities:id,amenity_name,amenity_icon,amenity_icon_color,amenity_description',
            ]);
        }

        return $relations;
    }
}
