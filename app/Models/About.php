<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class About extends Model
{
    use HasFactory, softDeletes;

    //    protected $fillable = ['title', 'content'];
}
