<?php

declare(strict_types=1);

use App\Exceptions\SystemExceptionHandler;
use App\Http\Middleware\SanitizeInput;
use App\Services\ElasticSearchService;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trimStrings();
        $middleware->convertEmptyStringsToNull();

        $middleware->append(SanitizeInput::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //        $exceptions->render(function (Throwable $e, Request $request) {
        //            $className = get_class($e);
        //
        //            $handlers = SystemExceptionHandler::$handlers;
        //
        //            if (array_key_exists($className, $handlers)) {
        //                $method = $handlers[$className];
        //                $apiHandler = new SystemExceptionHandler();
        //
        //                return $apiHandler->$method($e, $request);
        //            }
        //
        //            return response()->json([
        //                'error' => [
        //                    'type' => basename(get_class($e)),
        //                    'status' => $e->getCode() ?: 500,
        //                    'message' => $e->getMessage() ?: 'An unexpected error occurred',
        //                    'timestamp' => now()->toISOString(),
        //                    //                    'debug' => app()->environment('local', 'testing') ? [
        //                    //                        'file' => $e->getFile(),
        //                    //                        'line' => $e->getLine(),
        //                    //                        'trace' => $e->getTraceAsString()
        //                    //                    ] : null
        //                ],
        //            ], $e->getCode() ?: 500);
        //        });

        $exceptions->render(function (Throwable $e, Request $request) {
            // Only handle API requests and JSON-expected requests
            //            if (! $request->expectsJson() && ! $request->is('api/*')) {
            //                return null; // Let Laravel handle web requests normally
            //            }

            $className = get_class($e);
            $handlers = SystemExceptionHandler::$handlers;

            if (array_key_exists($className, $handlers)) {
                $method = $handlers[$className];
                $apiException = new SystemExceptionHandler(
                    app(ElasticSearchService::class)
                );

                return $apiException->$method($e, $request);
            }

            // Fallback for unhandled exceptions
            $apiException = new SystemExceptionHandler(
                app(ElasticSearchService::class)
            );
            $apiException->logToElasticsearch($e, $request, [
                'tags' => ['unhandled_exception', config('app.env')],
                'severity' => 'critical',
            ]);

            return response()->json([
                'error' => [
                    'type' => basename(get_class($e)),
                    'status' => method_exists($e, 'getStatusCode')
                        ? $e->getStatusCode()
                        : ($e->getCode() > 0 ? $e->getCode() : 500),
                    'message' => config('app.debug')
                        ? $e->getMessage()
                        : 'An unexpected error occurred.',
                    'timestamp' => now()->toISOString(),
                    'request_id' => $request->header('X-Request-ID') ?? 'unknown',
                ],
            ], method_exists($e, 'getStatusCode')
                ? $e->getStatusCode()
                : ($e->getCode() > 0 ? $e->getCode() : 500));
        });
    })->create();
