<?php

declare(strict_types=1);

namespace App\Actions;

final class ResolvePropertyClassAction
{
    public function execute(string $path): string
    {
        if ($path === 'home') {
            return 'col-span-12 lg:col-span-10';
        }
        if ($path === 'properties') {
            return 'col-span-12 lg:col-span-12';
        }
        if ($path === 'details') {
            return 'mb-8';
        }

        return '';
    }
}
