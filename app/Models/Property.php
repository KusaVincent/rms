<?php

declare(strict_types=1);

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Laravel\Scout\Searchable;
/**
 * @mixin Model
 *
 * @property int $id
 * @property int $property_type_id
 *
 * @method static findOrFail($id)
 * @method static where(string $string, $propertyType)
 */
final class Property extends Model
{
    use HasFactory;
    //    use Searchable;
    //    use SoftDeletes;
    //    use CascadeSoftDeletes;

    protected $fillable = [
        'propertyTitle',
        'propertyType',
        'propertyRent',
        'propertyDeposit',
        'distance',
        'propertyMap',
        'propertyImage',
        'propertyVideo',
        'description',
        'propertyLocation',
        'floorNumber',
        'buildingFloors',
        'tiled',
        'rented',
        'kitchen',
        'shower',
        'security',
        'garbage',
        'water',
        'balcony',
        'closet',
        'wifi',
        'network',
        'hangingLine',
        'playground',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tiled' => 'boolean',
        'rented' => 'boolean',
        'kitchen' => 'boolean',
        'shower' => 'boolean',
        'security' => 'boolean',
        'garbage' => 'boolean',
        'water' => 'integer',
        'balcony' => 'boolean',
        'closet' => 'boolean',
        'network' => 'boolean',
        'wifi' => 'boolean',
        'hangingLine' => 'boolean',
        'playground' => 'integer',
        'deleted' => 'boolean',
    ];

    /**
     * @return BelongsTo<PropertyType, Property>
     */
    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    /**
     * @return BelongsTo<Location, Property>
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return BelongsToMany<Amenity>
     */
    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class, 'property_amenities');
    }

    public function leaseAgreements(): HasMany
    {
        return $this->hasMany(LeaseAgreement::class);
    }

    public function maintenance(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }
}
