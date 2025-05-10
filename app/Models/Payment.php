<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Payment extends Model
{
    use HasFactory;

    public function leaseAgreement(): BelongsTo
    {
        return $this->belongsTo(LeaseAgreement::class, 'lease_id');
    }
}
