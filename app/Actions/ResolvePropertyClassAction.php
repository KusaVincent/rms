<?php

declare(strict_types=1);

namespace App\Actions;

final class ResolvePropertyClassAction
{
    public function execute(string $path): string
    {
        if ($path === '/') {
            return 'col-span-12 lg:col-span-10';
        }
        if ($path === 'properties') {
            return 'col-span-12 lg:col-span-12';
        }
        if (str_starts_with($path, 'property-details/')) {
            return 'mb-8';
        }

        return '';
    }
}
