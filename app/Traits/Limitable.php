<?php

declare(strict_types=1);

namespace App\Traits;

trait Limitable
{
    private const DEFAULT_LIMIT = 30;

    public function limit(): int
    {
        return (int) (config('app.property_number') ?? self::DEFAULT_LIMIT);
    }

    public function relatedLimit(): int
    {
        return (int) (config('app.related_property') ?? self::DEFAULT_LIMIT);
    }
}
