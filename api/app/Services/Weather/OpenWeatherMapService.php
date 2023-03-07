<?php

namespace App\Services\Weather;

use App\Interfaces\IWeatherService;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class OpenWeatherMapService implements IWeatherService
{
    private CONST API = 'https://api.openweathermap.org/data/2.5';

    /**
     * @param string $lat
     * @param string $lon
     * @return array
     * @throws GuzzleException
     */
    public function getCurrentWeather(string $lat, string $lon): array
    {
        $url = self::API . '/weather';

        $client = new Client;

        $response = $client->get($url, [
            'query' => [
                'lat'   => $lat,
                'lon'   => $lon,
                'appid' => env('OPEN_WEATHER_API_KEY'),
                'units' => 'metric',
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}
