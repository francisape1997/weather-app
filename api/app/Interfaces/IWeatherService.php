<?php

namespace App\Interfaces;

interface IWeatherService
{
    /**
     * @param string $lat
     * @param string $lon
     * @return array
     */
    public function getCurrentWeather(string $lat, string $lon) : array;
}
