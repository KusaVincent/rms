<?php

declare(strict_types=1);

namespace App\Traits;

trait Paginatable
{
    use Limitable;

    public function getPerPage(): int
    {
        return (int) (config('app.paginate') ?? self::DEFAULT_LIMIT);
    }
}
