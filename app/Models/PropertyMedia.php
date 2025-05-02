<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyMedia extends Model
{
    use HasFactory;

    protected $fillable = ['image_one','image_two','image_three','image_four','image_five','video'];

    public function property() : BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
