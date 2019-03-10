<?php

namespace  IanKok\SurfForecastApiClient\Test\Unit;

use IanKok\SurfForecastApiClient\Client\SurfForecastClient;
use IanKok\SurfForecastApiClient\Country\CountryMapper;
use IanKok\SurfForecastApiClient\Country\CountryRepository;
use IanKok\SurfForecastApiClient\Test\TestCase;
use PHPHtmlParser\Dom;

class CountryRepositoryTest extends TestCase
{

    /**
     * @test
     */
    public function itCanListCountries()
    {
        $client = new SurfForecastClient('http://www.surf-forecast.com/');
        $mapper = new CountryMapper(new Dom());
        $repo = new CountryRepository($client, $mapper);
        $repo->list();
        var_dump('test');
    }
}