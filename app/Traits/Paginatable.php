<?php

namespace App\Traits;

trait Paginatable
{
    public function getPerPage(): int
    {
        return (int) (config('app.paginate') ?? 30);
    }
}
