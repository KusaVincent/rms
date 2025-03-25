<?php

namespace App\Actions;

class ResolvePropertyClassAction
{
    public function execute(string $path): string
    {
        if ('/' === $path) {
            return "col-span-12 lg:col-span-10";
        } elseif ('properties' === $path) {
            return "col-span-12 lg:col-span-12";
        } elseif (str_starts_with($path, 'property-details/')) {
            return "mb-8";
        }

        return "";
    }
}
