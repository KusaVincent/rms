<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static whereNot(string $string, string $string1)
 * @method static create(string[] $contact)
 */
final class Contact extends Model
{
    use HasFactory, SoftDeletes;
}
