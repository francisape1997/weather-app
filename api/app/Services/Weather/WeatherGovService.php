<?php

namespace App\Services\Weather;

use App\Interfaces\IWeatherService;

class WeatherGovService implements IWeatherService
{
    public function getCurrentWeather(string $lat, string $lon): array
    {
        // TODO: Weather Gov Implementation Here
        return [];
    }
}
