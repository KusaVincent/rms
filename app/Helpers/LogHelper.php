<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Facades\ElasticSearch;

final class LogHelper
{
    public static function error($message, $status = 500)
    {
        return ElasticSearch::populateIndex('error', [
            'type' => 'Exception',
            'message' => $message,
            'status' => $status,
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    public static function success($message, $status = 200)
    {
        return ElasticSearch::populateIndex('success', [
            'type' => 'Message',
            'message' => $message,
            'status' => $status,
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    public static function warning($message, $status = 400)
    {
        return ElasticSearch::populateIndex('warning', [
            'type' => 'Warning',
            'message' => $message,
            'status' => $status,
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    public static function debug($message, $status = 200)
    {
        return ElasticSearch::populateIndex('debug', [
            'type' => 'DEBUG',
            'message' => $message,
            'status' => $status,
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    public static function info($message, $status = 100)
    {
        return ElasticSearch::populateIndex('info', [
            'type' => 'INFO',
            'message' => $message,
            'status' => $status,
            'timestamp' => now()->toIso8601String(),
        ]);
    }
}
