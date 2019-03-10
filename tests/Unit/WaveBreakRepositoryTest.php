<?php

namespace  IanKok\SurfForecastApiClient\Test\Unit;

use function GuzzleHttp\Promise\all;
use IanKok\SurfForecastApiClient\Client\SurfForecastClient;
use IanKok\SurfForecastApiClient\Country\CountryMapper;
use IanKok\SurfForecastApiClient\Country\CountryRepository;
use IanKok\SurfForecastApiClient\Entities\Country;
use IanKok\SurfForecastApiClient\Test\TestCase;
use IanKok\SurfForecastApiClient\WaveBreak\RegionMapper;
use IanKok\SurfForecastApiClient\WaveBreak\RegionRepository;
use PHPHtmlParser\Dom;

class CountryRepositoryTest extends TestCase
{

    /**
     * @test
     */
    public function itCanListWaveBreaks()
    {
        $client = new SurfForecastClient('http://www.surf-forecast.com/');
        $mapper = new CountryMapper(new Dom());
        $repo = new CountryRepository($client, $mapper);

        $breakMapper = new RegionMapper(new Dom());
        $breakRepo = new RegionRepository($client, $breakMapper);
        $items = $repo->list();
        $promises = array_map(function (Country $item) use ($breakRepo){
            $break = $breakRepo->getByCountryId($item->getValue());
            return $break;
        }, $items);
        all($promises)->wait();
        var_dump($promises);
    }
}