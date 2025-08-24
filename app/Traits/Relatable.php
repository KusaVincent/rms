<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Property;

trait Relatable
{
    use Selectable;

    public function relatedProperties(string $slug, bool $amenities = false)
    {
        return Property::select($this->selects())
            ->isAvailable()
            ->with($this->relations($amenities))
            ->whereSlug($slug)
            ->firstOrFail();
    }
}
