<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class ServiceAvailability extends Model
{
    use HasFactory;

//    protected $fillable = ['service_key', 'is_active', 'service_name'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
