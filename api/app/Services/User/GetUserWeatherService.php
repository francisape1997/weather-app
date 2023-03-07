<?php

namespace App\Services\User;

use App\Interfaces\ICacheService;
use App\Interfaces\IWeatherService;

class GetUserWeatherService
{
    /**
     * @param IWeatherService $weatherService
     * @param ICacheService $cacheService
     */
    public function __construct(
        private IWeatherService $weatherService,
        private ICacheService $cacheService,
    ) {}

    /**
     * Cache Key Format - {WEATHER_PROVIDER_CONFIG}:{USER_ID}:{USER_LONGITUDE}:{USER_LATITUDE}
     * @param array $user
     * @return array
     */
    public function handle(array $user) : array
    {
        $weatherProviderConfig = config('weather.api');

        $cacheKey = "$weatherProviderConfig:{$user['id']}:{$user['longitude']}:{$user['latitude']}";

        $weatherCacheData = $this->cacheService->get($cacheKey);

        if (is_null($weatherCacheData)) {
            $weather = $this->weatherService->getCurrentWeather($user['latitude'], $user['longitude']);

            $this->cacheService->set($cacheKey, json_encode($weather, true)); // Default is 1 hour
        } else {
            $weather = json_decode($weatherCacheData, true);
        }

        return $weather;
    }
}
