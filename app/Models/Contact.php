<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Contact extends Model
{
    use HasFactory, SoftDeletes;

    //    protected $fillable = ['icon', 'label', 'link', 'link_text'];
}
