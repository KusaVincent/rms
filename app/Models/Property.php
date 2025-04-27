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
use Laravel\Scout\Searchable;
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
    use HasFactory, Searchable;
    //    use SoftDeletes;
    //    use CascadeSoftDeletes;

    protected $fillable = [
        'rent',
        'deposit',
        'location_id',
        'description',
        'availability',
        'property_name',
        'property_image',
        'property_type_id',
    ];

    /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string
    {
        return 'property_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return array_merge($this->toArray(),[
            'id' => (string) $this->id,
            'rent' => (string) $this->rent,
            'area' => $this->location->area,
            'town_city' => $this->location->town_city,
            'type_name' =>$this->propertyType->type_name,
            'created_at' => $this->created_at->timestamp,
        ]);
    }

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
