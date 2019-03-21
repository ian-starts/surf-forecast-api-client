<?php

namespace  IanKok\SurfForecastApiClient\Test\Unit;

use IanKok\SurfForecastApiClient\Client\SurfForecastClient;
use IanKok\SurfForecastApiClient\Country\CountryMapper;
use IanKok\SurfForecastApiClient\Country\CountryRepository;
use IanKok\SurfForecastApiClient\Forecast\ForeCastMapper;
use IanKok\SurfForecastApiClient\Forecast\ForecastRepository;
use IanKok\SurfForecastApiClient\Test\TestCase;
use PHPHtmlParser\Dom;

class ForeCastRepositoryTest extends TestCase
{

    /**
     * @test
     */
    public function itCanList48HrsForecast()
    {
        $client = new SurfForecastClient('http://www.surf-forecast.com/');
        $mapper = new ForeCastMapper(new Dom());
        $repo = new ForecastRepository($client, $mapper);
        $items = $repo->get48Hrs('Canggu')->wait();
        var_dump($items);
    }
}