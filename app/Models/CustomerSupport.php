<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $all)
 */
final class CustomerSupport extends Model
{
    protected $fillable = ['name', 'phone_number', 'message', 'email', 'subject'];
}