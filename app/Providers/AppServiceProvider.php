<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\ElasticSearchService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('elasticsearchservice', fn($app): \App\Services\ElasticSearchService => new ElasticSearchService());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Model::automaticallyEagerLoadRelationships();
    }
}
