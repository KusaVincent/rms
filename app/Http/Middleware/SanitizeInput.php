<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

final class SanitizeInput
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sanitized = $this->sanitizeArray($request->all());
        $request->merge($sanitized);

        return $next($request);
    }

    private function sanitizeArray(array $data): array
    {
        $sanitized = [];

        foreach ($data as $key => $value) {
            $sanitized[$key] = $this->sanitizeValue($value, (string) $key);
        }

        return $sanitized;
    }

    private function sanitizeValue(mixed $value, string $key): mixed
    {
        if (is_array($value)) {
            return $this->sanitizeArray($value);
        }

        if (is_string($value)) {
            $value = mb_trim(strip_tags($value));

            $keyLower = Str::lower($key);

            if (Str::contains($keyLower, 'email')) {
                return Str::lower($value);
            }

            if (Str::contains($keyLower, 'name')) {
                return $this->formatName($value);
            }

            if (Str::contains($keyLower, 'subject') || Str::contains($keyLower, 'message')) {
                return Str::ucfirst($value);
            }

            return $value;
        }

        return $value;
    }

    private function formatName(string $value): string
    {
        return Str::title(Str::lower($value));
    }
}
