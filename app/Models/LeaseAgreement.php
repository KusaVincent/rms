<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class LeaseAgreement extends Model
{
    use HasFactory;

//    protected $fillable = [
//        'tenant_id',
//        'property_id',
//        'lease_start_date',
//        'lease_end_date',
//        'rent_amount',
//        'deposit_amount',
//        'lease_term',
//    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
