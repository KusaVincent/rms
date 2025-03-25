<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maintenance extends Model
{    use HasFactory;

    protected $fillable = [
        'property_id',
        'tenant_id',
        'description',
        'status',
        'request_date',
        'completion_date'
    ];

    public function property():BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function tenant():BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
