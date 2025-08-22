<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static inRandomOrder()
 * @method static create(string[] $amenity)
 */
final class Amenity extends Model
{
    use HasFactory;

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)
            ->using(AmenityProperty::class)
            ->withPivot(['created_by'])
            ->withTimestamps();
    }
}
