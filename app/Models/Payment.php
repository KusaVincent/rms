<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['lease_id', 'payment_date', 'payment_amount', 'payment_method'];

    public function leaseAgreement():BelongsTo
    {
        return $this->belongsTo(LeaseAgreement::class, 'lease_id');
    }
}
