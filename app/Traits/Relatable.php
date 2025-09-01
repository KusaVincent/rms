<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Property;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait Relatable
{
    use Selectable;

    /**
     * @throws ModelNotFoundException
     */
    public function relatedProperties(string $slug, bool $amenities = false): Property
    {
        return Property::select($this->selects())
            ->isAvailable()
            ->with($this->relations($amenities))
            ->whereSlug($slug)
            ->firstOrFail();
    }
}
