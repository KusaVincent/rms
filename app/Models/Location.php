<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static select(string $string, string $string1)
 * @method static inRandomOrder()
 */
final class Location extends Model
{
    use HasFactory;

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
