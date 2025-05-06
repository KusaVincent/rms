<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Founder extends Model
{
    use HasFactory, softDeletes;

    //    protected $fillable = ['name', 'image', 'social_media'];

    protected $casts = [
        'social_media' => 'json:unicode',
    ];
}
