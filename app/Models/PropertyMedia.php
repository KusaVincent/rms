<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class PropertyMedia extends Model
{
    use HasFactory;

//    protected $fillable = ['image_one', 'image_two', 'image_three', 'image_four', 'image_five', 'video'];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
