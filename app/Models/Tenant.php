<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @template TFactory of Factory
 *
 * @mixin Model
 *
 * @method static inRandomOrder()
 */
final class Tenant extends Model
{
    use HasFactory;

    /**
     * @return HasMany<LeaseAgreement, Tenant>
     */
    public function leaseAgreements(): HasMany
    {
        return $this->hasMany(LeaseAgreement::class);
    }

    /**
     * @return HasMany<Maintenance, Tenant>
     */
    public function maintenance(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }
}
