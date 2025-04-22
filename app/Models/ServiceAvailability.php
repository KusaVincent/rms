<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAvailability extends Model
{
    use HasFactory;

    protected $fillable = ['service_key', 'is_active', 'service_name'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
