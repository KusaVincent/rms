<?php

declare(strict_types=1);

namespace App\Traits;

trait Paginatable
{
    public function getPerPage(): int
    {
        return (int) (config('app.paginate') ?? 30);
    }
}
