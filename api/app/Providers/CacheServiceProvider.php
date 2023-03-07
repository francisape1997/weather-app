<?php

namespace App\Providers;

use App\Services\Cache\RedisCacheService;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\ICacheService;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ICacheService::class, function() {
            return match(env('CACHE_DRIVER')) {
                'redis' => new RedisCacheService,
                // Other services here.
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
