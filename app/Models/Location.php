<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'city', 'state', 'zip_code'];

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
