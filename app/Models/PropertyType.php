<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class PropertyType extends Model
{
    use HasFactory;

    protected $fillable = ['type_name'];

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
