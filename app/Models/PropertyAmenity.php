<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class PropertyAmenity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
//    protected $fillable = ['property_id','amenity_id'];

    /**
     * Relationships.
     */

    // Property relationship
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    // Amenity relationship
    public function amenity(): BelongsTo
    {
        return $this->belongsTo(Amenity::class);
    }
}
