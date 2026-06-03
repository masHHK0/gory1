<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    public function getSkiWeather()
    {
        return Cache::remember('weather_data', 60, function () {
            // Координаты Шерегеша
              $lat = 52.9200;
        $lon = 87.9900;
            
            try {
                $response = Http::timeout(10)->get('https://api.open-meteo.com/v1/forecast', [
                    'latitude' => $lat,
                    'longitude' => $lon,
                    'current' => 'temperature_2m,relative_humidity_2m,wind_speed_10m,weather_code',
                    'daily' => 'temperature_2m_max,temperature_2m_min,snowfall_sum',
                    'timezone' => 'Asia/Novokuznetsk',
                    'forecast_days' => 1,
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    
                    $baseTemp = (int)round($data['current']['temperature_2m']);
                    $weatherCode = $data['current']['weather_code'];
                    $windSpeed = (int)round($data['current']['wind_speed_10m']);
                    $snowfall = $data['daily']['snowfall_sum'][0] ?? 0;
                    
                    // Иконки и описания по кодам WMO
                    $weatherInfo = $this->getWeatherInfo($weatherCode);
                    
                    return [
                        'weather' => [
                            [
                                'top' => [
                                    [
                                        'tempMaxC' => (string)($baseTemp - 8),
                                        'tempMinC' => (string)($baseTemp - 13),
                                        'weatherIconUrl' => [['value' => $weatherInfo['icon']]],
                                        'weatherDesc' => [['value' => $weatherInfo['desc']]],
                                        'WindChillC' => (string)($windSpeed + 5),
                                        'totalSnowfall_cm' => (string)($snowfall + 5),
                                    ]
                                ],
                                'mid' => [
                                    [
                                        'tempMaxC' => (string)($baseTemp - 4),
                                        'tempMinC' => (string)($baseTemp - 8),
                                        'weatherIconUrl' => [['value' => $weatherInfo['icon']]],
                                        'weatherDesc' => [['value' => $weatherInfo['desc']]],
                                        'WindChillC' => (string)($windSpeed + 2),
                                        'totalSnowfall_cm' => (string)($snowfall + 2),
                                    ]
                                ],
                                'bottom' => [
                                    [
                                        'tempMaxC' => (string)$baseTemp,
                                        'tempMinC' => (string)($baseTemp - 4),
                                        'weatherIconUrl' => [['value' => $weatherInfo['icon']]],
                                        'weatherDesc' => [['value' => $weatherInfo['desc']]],
                                        'WindChillC' => (string)$windSpeed,
                                        'totalSnowfall_cm' => (string)$snowfall,
                                    ]
                                ],
                            ]
                        ]
                    ];
                }
            } catch (\Exception $e) {
                \Log::error('Weather error: ' . $e->getMessage());
            }
            
            return null;
        });
    }
    
    // Коды погоды WMO → иконки и описания
    private function getWeatherInfo($code)
    {
        $codes = [
            0 => ['icon' => 'https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0001_sunny.png', 'desc' => 'Ясно'],
            1 => ['icon' => 'https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0002_sunny_intervals.png', 'desc' => 'Малооблачно'],
            2 => ['icon' => 'https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0003_cloudy.png', 'desc' => 'Облачно'],
            3 => ['icon' => 'https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0004_cloudy.png', 'desc' => 'Пасмурно'],
            45 => ['icon' => 'https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0007_mist.png', 'desc' => 'Туман'],
            48 => ['icon' => 'https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0007_mist.png', 'desc' => 'Изморозь'],
            51 => ['icon' => 'https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0017_cloudy_with_light_rain.png', 'desc' => 'Морось'],
            61 => ['icon' => 'https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0018_cloudy_with_heavy_rain.png', 'desc' => 'Дождь'],
            71 => ['icon' => 'https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0020_cloudy_with_light_snow.png', 'desc' => 'Снег'],
            73 => ['icon' => 'https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0021_cloudy_with_snow.png', 'desc' => 'Снегопад'],
            75 => ['icon' => 'https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0022_cloudy_with_heavy_snow.png', 'desc' => 'Сильный снег'],
            77 => ['icon' => 'https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0019_cloudy_with_snow.png', 'desc' => 'Снежные зёрна'],
            95 => ['icon' => 'https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0024_thunderstorms.png', 'desc' => 'Гроза'],
        ];
        
        return $codes[$code] ?? ['icon' => 'https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0001_sunny.png', 'desc' => '—'];
    }
}