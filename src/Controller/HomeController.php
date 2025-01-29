<?php

namespace App\Controller;

use App\Service\WeatherApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    public $weather;

   


    #[Route('/home', name: 'app_home')]
    public function index(WeatherApiService $apiService): Response
    {
         function getWeatherIcon(WeatherApiService $apiService):string
        {
         $weather= $apiService->getFranceData();
            return $weather["current"]["weather_code"];
        }

        function isDayOrNight(WeatherApiService $apiService):string
        {
         $weather= $apiService->getFranceData();
            return $weather["current"]["is_day"];
        }

        function setWeatherIcon(string $code, string $dayOrNight)
        {  
            $weather = [];
            if($dayOrNight == "1")
            {
                switch($code){
                    case "0" : $weather = [
                        "alt" => "Ciel bleu",
                        "icon" => "media/cloudy.png" 
                      ];;
                    break;
                    case "1" :
                    case "2" :
                    case "3" :
                        $weather = [
                          "alt" => "Nuageux",
                          "icon" => "media/cloudy.png" 
                        ];
                        break;
                    case str_starts_with($code, "4"):
                        $weather = [
                            "alt" => "Brouillard",
                            "icon" => "media/fog.png" 
                          ];
                        break;
                    case str_starts_with($code, "5") :
                        $weather = [
                            "alt" => "Bruine",
                            "icon" => "media/cloudy.png" 
                          ];
                        break;
                    case str_starts_with($code, "6"): 
                        $weather = [
                            "alt" => "Pluie",
                            "icon" => "media/cloudy.png" 
                          ];
                        break;
                    case "71":
                    case "73":
                    case "75": 
                        $weather= [
                            "alt" => "Neige",
                            "icon" => "media/cloudy.png" 
                          ];
                        break;
                    case "77":
                        $weather = [
                            "alt" => "Grêle",
                            "icon" => "media/cloudy.png" 
                          ];
                        break;
                    case str_starts_with($code, "8") :
                        $weather = [
                            "alt" => "Averse",
                            "icon" => "media/drizzle.png" 
                          ];
                        break;
                    case str_starts_with($code, "9") : 
                        $weather = [
                            "alt" => "Orage",
                            "icon" => "media/storm.png" 
                          ];
                        break;
                    default : 
                    $weather = "Oops, Impossible de savoir le temps qu'il fait";
                }
            } else{
                switch($code){
                    case "0" : $weather = [
                        "alt" => "Ciel dégagé",
                        "icon" => "media/good-night.png" 
                      ];
                    break;
                    case "1" :
                    case "2" :
                    case "3" :
                        $weather = [
                          "alt" => "Nuageux",
                          "icon" => "media/night.png" 
                        ];
                        break;
                    case str_starts_with($code, "4"):
                        $weather = [
                            "alt" => "Brouillard",
                            "icon" => "media/fog.png" 
                          ];
                        break;
                    case str_starts_with($code, "5") || str_starts_with($code, "6") :
                        $weather = [
                            "alt" => "Pluie",
                            "icon" => "media/raining.png" 
                          ];
                        break;
                
                    case "71":
                    case "73":
                    case "75": 
                        $weather= [
                            "alt" => "Neige",
                            "icon" => "media/night_snow.png" 
                          ];
                        break;
                    case "77":
                        $weather = [
                            "alt" => "Grêle",
                            "icon" => "media/cloudy.png" 
                          ];
                        break;
                    case str_starts_with($code, "8") :
                        $weather = [
                            "alt" => "Averse",
                            "icon" => "media/cloudy.png" 
                          ];
                        break;
                    case str_starts_with($code, "9") : 
                        $weather = [
                            "alt" => "Orage",
                            "icon" => "media/thunder.png" 
                          ];
                        break;
                    default : 
                    $weather = "Oops, Impossible de savoir le temps qu'il fait";
            }
        }
            return $weather;
        }

     //dd(getWeatherIcon($apiService)) ;  
       // dd($apiService->getFranceData());
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'datas' => $apiService->getFranceData(),
            'weather' => setWeatherIcon(getWeatherIcon($apiService),isDayOrNight($apiService))
        ]);
    }
}
