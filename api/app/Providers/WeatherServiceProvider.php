<?php

namespace App\Providers;

use App\Services\Weather\OpenWeatherMapService;
use App\Services\Weather\WeatherGovService;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\IWeatherService;

class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IWeatherService::class, function() {
            return match(config('weather.api'))
            {
                'open_weather_map' => new OpenWeatherMapService,
                'weather_gov' => new WeatherGovService,
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
