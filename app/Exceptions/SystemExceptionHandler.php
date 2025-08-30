<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

final class SystemExceptionHandler extends BaseSystemExceptionHandler
{
    public static array $handlers = [
        AuthenticationException::class => 'handleAuthenticationException',
        ValidationException::class => 'handleValidationException',
        ModelNotFoundException::class => 'handleNotFoundException',
        NotFoundHttpException::class => 'handleNotFoundException',
        AuthorizationException::class => 'handleAuthorizationException',
        MethodNotAllowedHttpException::class => 'handleMethodNotAllowedHttpException',
        HttpException::class => 'handleHttpException',
        QueryException::class => 'handleQueryException',
        AccessDeniedHttpException::class => 'handleAuthenticationException',
    ];

    /**
     * Handle Authentication Exception (401 Unauthorized).
     */
    public function handleAuthenticationException(AuthenticationException|AccessDeniedHttpException $e, Request $request): JsonResponse
    {
        $this->logToElasticsearch($e, $request); // Log exception

        return $this->errorResponse($e, 401);
    }

    /**
     * Handle Authorization Exception (403 Forbidden).
     */
    public function handleAuthorizationException(AuthorizationException $e, Request $request): JsonResponse
    {
        // Log custom message for authorization exceptions
        Log::notice(basename(get_class($e)).' - '.$e->getMessage().' - Line: '.$e->getLine());

        return $this->errorResponse($e, 403);
    }

    /**
     * Handle Method Not Allowed Exception (405 Method Not Allowed).
     */
    public function handleMethodNotAllowedHttpException(MethodNotAllowedHttpException $e, Request $request): JsonResponse
    {
        return $this->errorResponse($e, 405);
    }

    /**
     * Handle HTTP Exception (General).
     */
    public function handleHttpException(HttpException $e, Request $request): JsonResponse
    {
        return $this->errorResponse($e, $e->getStatusCode());
    }

    /**
     * Handle Validation Exception (422 Unprocessable Entity).
     */
    public function handleValidationException(ValidationException $e, Request $request): JsonResponse
    {
        // Log the validation exception
        $this->logToElasticsearch($e, $request);

        // Map validation errors into response format
        $errors = collect($e->errors())->map(fn ($messages, $field) => [
            'field' => $field,
            'messages' => $messages,
        ]);

        return response()->json([
            'errors' => $errors,
        ], 422);
    }

    /**
     * Handle Not Found Exception (404 Not Found).
     */
    public function handleNotFoundException(ModelNotFoundException|NotFoundHttpException $e, Request $request): JsonResponse
    {
        return $this->errorResponse($e, 404, 'Not Found '.$request->getRequestUri());
    }

    /**
     * Handle Query Exception (500 Internal Server Error).
     */
    public function handleQueryException(QueryException $e, Request $request): JsonResponse
    {
        // Log to Elasticsearch
        $this->logToElasticsearch($e, $request);

        // Check for specific SQL error code 1451 (foreign key constraint violation)
        if ($e->errorInfo[1] === 1451) {
            return $this->errorResponse($e, 409, 'This resource cannot be deleted due to a foreign key constraint.');
        }

        return $this->errorResponse($e, 500);
    }

    /**
     * Helper to create error response in a consistent format.
     */
    private function errorResponse(Throwable $e, int $status, ?string $message = null): JsonResponse
    {
        $message = $message ?? $e->getMessage();

        return response()->json([
            'error' => [
                'type' => self::getType($e),
                'status' => $status,
                'message' => $message,
            ],
        ], $status);
    }

    public static function handleElasticsearchException(Exception $e): array
    {
        // Log the exception for monitoring or debugging
        Log::error('Elasticsearch Error: ' . $e->getMessage(), [
            'exception' => $e,
            'trace' => $e->getTraceAsString()
        ]);

        // Return a generic error response with the exception message
        return [
            'error' => [
                'type' => 'ElasticsearchException',
                'status' => 500,
                'message' => 'An error occurred while interacting with Elasticsearch. Please try again later.',
            ]
        ];
    }
}
