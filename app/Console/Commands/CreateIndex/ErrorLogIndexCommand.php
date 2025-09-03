<?php

declare(strict_types=1);

namespace App\Console\Commands\CreateIndex;

use App\Services\ElasticSearchService;
use Illuminate\Console\Command;

final class ErrorLogIndexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-index:error-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = ' artisan create-index:error-logs';

    /**
     * The name of the index.
     */
    private string $indexName = 'error-logs';

    /**
     * Create a new command instance.
     */
    public function __construct(/**
     * The Elasticsearch service instance.
     */
        private readonly ElasticSearchService $elasticsearchService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if ($this->elasticsearchService->indexExists($this->indexName)) {
            $this->info("Index '{$this->indexName}' already exists.");

            return;
        }

        $settings = [
            'number_of_shards' => 1,
            'number_of_replicas' => 1,
            'refresh_interval' => '1s',
        ];

        $mapping = [
            'properties' => [
                'type' => [
                    'type' => 'keyword',
                    'index' => true,
                ],
                'message' => [
                    'type' => 'text',
                    'analyzer' => 'standard',
                    'fields' => [
                        'keyword' => [
                            'type' => 'keyword',
                            'ignore_above' => 256,
                        ],
                    ],
                ],
                'status' => [
                    'type' => 'integer',
                ],
                'uri' => [
                    'type' => 'keyword',
                    'index' => true,
                ],
                'method' => [
                    'type' => 'keyword',
                    'index' => true,
                ],
                'user' => [
                    'type' => 'object',
                    'properties' => [
                        'id' => [
                            'type' => 'keyword',
                        ],
                        'name' => [
                            'type' => 'text',
                            'fields' => [
                                'keyword' => [
                                    'type' => 'keyword',
                                    'ignore_above' => 256,
                                ],
                            ],
                        ],
                        'type' => [
                            'type' => 'keyword',
                        ],
                    ],
                ],
                'ip' => [
                    'type' => 'ip',
                    'index' => true,
                ],
                'trace' => [
                    'type' => 'text',
                    'index' => false,
                ],
                'timestamp' => [
                    'type' => 'date',
                    'format' => 'strict_date_time',
                ],
                'environment' => [
                    'type' => 'keyword',
                    'index' => true,
                ],
                'file' => [
                    'type' => 'keyword',
                    'index' => true,
                ],
                'line' => [
                    'type' => 'integer',
                ],
                'request_data' => [
                    'type' => 'object',
                    'enabled' => false,
                ],
                'headers' => [
                    'type' => 'object',
                    'enabled' => false,
                ],
            ],
        ];

        $this->elasticsearchService->createIndex($this->indexName, $settings, $mapping);
        $this->info("Index '{$this->indexName}' created successfully.");
    }
}
