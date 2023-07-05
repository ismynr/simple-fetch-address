<?php

namespace App\Providers;

use App\Domains\SearchProvider\SearchProviderInterface;
use App\Helpers\APIClient;
use App\Http\Infrastructure\SearchProvider\ApiDataProvider;
use App\Http\Infrastructure\SearchProvider\DatabaseProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SearchProviderInterface::class, function ($app) {
            $dataSource = env('DATA_SOURCE_ADDRESS');

            return match ($dataSource) {
                'database' => new DatabaseProvider(),
                'api' => new ApiDataProvider(new APIClient()),
                default => throw new \Exception("Invalid data source configuration"),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
