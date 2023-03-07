<?php

namespace Tests\Feature;

use App\Interfaces\ICacheService;
use App\Interfaces\IWeatherService;
use App\Models\User;
use App\Services\User\GetUserWeatherService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private const DUMMY_OPEN_WEATHER_API_WEATHER_DATA =
    [
        'coord' => [
            'lon' => '',
            'lat' => '',
        ],
        'weather' => [
            [
                'id' => 802,
                'main' => 'Clouds',
                'description' => 'scattered clouds',
                'icon' => '03d',
            ]
        ],
        'main' => [
            'temp' => -29.56,
            'feels_like' => -36.56,
            'temp_min' => -29.56,
            'temp_max' => -29.56,
            'pressure' => 993,
            'humidity' => 90,
            'sea_level' => 993,
            'grnd_level' => 835,
        ],
        'wind' => [
            'speed' => 5.56,
            'deg' => 47,
            'gust' => 6.76,
        ],
        'clouds' => [
            'all' => 47,
        ],
        'dt' => 1678112862,
        'sys' => [
            'sunrise' => 1678096122,
            'sunset' => 1678168920,
        ],
        'timezone' => -28800,
        'id' => 0,
        'name' => '',
        'cod' => 200,
    ];

    private const DUMMY_WEATHER_GOV_API_WEATHER_DATA = [];

    /**
     * @return void
     */
    public function test_fetch_weather() : void
    {
        $weatherServiceMock = $this->createMock(IWeatherService::class);

        $lat = $this->faker->latitude;
        $lon = $this->faker->longitude;

        if (config('weather.api') === 'open_weather_map') {
            $expectedResult = self::DUMMY_OPEN_WEATHER_API_WEATHER_DATA;
            $expectedResult['coord']['lon'] = $lon;
            $expectedResult['coord']['lat'] = $lat;
        } else {
            // Weather Gov Implementation
            $expectedResult = self::DUMMY_WEATHER_GOV_API_WEATHER_DATA;
        }

        $weatherServiceMock->expects($this->once())
                           ->method('getCurrentWeather')
                           ->with($lat, $lon)
                           ->willReturn($expectedResult);

        $result = $weatherServiceMock->getCurrentWeather($lat, $lon);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @return void
     */
//    public function test_weather_data_should_be_one_hour_only() : void
//    {
//        // Generate a User
//        $user = User::factory()->create()->toArray();
//
//        // Get weather api config
//        $weatherProviderConfig = config('weather.api');
//
//        // Set cache key
//        $cacheKey = "$weatherProviderConfig:{$user['id']}:{$user['longitude']}:{$user['latitude']}";
//
//        // Mock Weather Service
//        $weatherServiceMock = $this->createMock(IWeatherService::class);
//
//        if (config('weather.api') === 'open_weather_map') {
//            $expectedResult = self::DUMMY_OPEN_WEATHER_API_WEATHER_DATA;
//            $expectedResult['coord']['lon'] = $user['longitude'];
//            $expectedResult['coord']['lat'] = $user['latitude'];
//        } else {
//            // Weather Gov Implementation
//            $expectedResult = self::DUMMY_WEATHER_GOV_API_WEATHER_DATA;
//        }
//
//        // Set expected data
//        $weatherServiceMock->expects($this->once())
//                           ->method('getCurrentWeather')
//                           ->with($user['latitude'], $user['longitude'])
//                           ->willReturn($expectedResult);
//
//        // Mock the cache service
//        $cacheServiceMock = $this->getMockBuilder(ICacheService::class)->onlyMethods(['get', 'set', 'delete']);
//
//        $cacheServiceMock = $cacheServiceMock->getMock();
//
//        // Define the data that will be returned from cache
//        $cacheServiceMock->expects($this->once())
//                         ->method('get')
//                         ->with($cacheKey)
//                         ->willReturn(json_encode($expectedResult, true));
//
//        $this->app->instance(ICacheService::class, $cacheServiceMock);
//
//        // Get the User Weather Service instance
//        $getUserWeatherService = $this->app->make(GetUserWeatherService::class, ['weatherService' => $weatherServiceMock, 'cacheService' => $cacheServiceMock]);
//
//        $this->travel(1)->hour();
//
//        $weather = $getUserWeatherService->handle($user);
//
//        $this->assertNull($weather);
//    }
}
