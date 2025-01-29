<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherApiService {

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this -> client = $client;
    }

    public function getFranceData() : array
    {
        $response = $this->client->request(
            'GET',
            'https://api.open-meteo.com/v1/forecast?latitude=43.225&longitude=1.5749998&current=temperature_2m,apparent_temperature,is_day,precipitation,weather_code,wind_speed_10m&hourly=temperature_2m,apparent_temperature&timezone=Europe%2FLondon&forecast_days=1'
        );
        return $response -> toArray() ;
    }
}