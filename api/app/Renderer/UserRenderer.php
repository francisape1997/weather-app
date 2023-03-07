<?php

namespace App\Renderer;

use App\Services\User\GetUserWeatherService;
use JetBrains\PhpStorm\ArrayShape;

class UserRenderer extends Renderer
{
    /**
     * @param GetUserWeatherService $getUserWeatherService
     */
    public function __construct(private GetUserWeatherService $getUserWeatherService) {}

    /**
     * @param array $class
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'name' => "mixed", 'email' => "mixed", 'latitude' => "mixed", 'longitude' => "mixed", 'weather' => "array"])]
    public function render(array $class) : array
    {
        return [
            'id'        => $class['id'],
            'name'      => $class['name'],
            'email'     => $class['email'],
            'latitude'  => $class['latitude'],
            'longitude' => $class['longitude'],
            'weather'   => $this->getUserWeatherService->handle($class),
        ];
    }
}
