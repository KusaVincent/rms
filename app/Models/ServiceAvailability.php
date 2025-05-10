<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $serviceKey)
 * @method static create(array $serviceAvailability)
 */
final class ServiceAvailability extends Model
{
    use HasFactory;

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
