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
        $clean = function ($value, $key = null) use (&$clean) {
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    $value[$k] = $clean($v, $k);
                }

                return $value;
            }

            if (is_string($value)) {
                $value = mb_trim(strip_tags($value));

                if ($key !== null && str_contains(Str::lower((string) $key), 'email')) {
                    return Str::lower($value);
                }

                return $value;
            }

            return $value;
        };

        $sanitized = $clean($request->all());
        $request->merge($sanitized);

        return $next($request);
    }
}
