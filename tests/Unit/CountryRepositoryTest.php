<?php

namespace  IanKok\SurfForecastApiClient\Test\Unit;

use IanKok\SurfForecastApiClient\Country\CountryMapper;
use IanKok\SurfForecastApiClient\Country\CountryRepository;
use IanKok\SurfForecastApiClient\Test\TestCase;
use IanKok\SurfForecastApiClient\Test\TestLib\FakeClients\FakeSurfForecastClient;
use PHPHtmlParser\Dom;

class CountryRepositoryTest extends TestCase
{
    protected $client;

    protected $countryRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->client = new FakeSurfForecastClient('');
        $this->countryRepository = new CountryRepository($this->client, new CountryMapper(new Dom()));
    }

    /**
     * @test
     */
    public function itCanListCountries()
    {
        $items = $this->countryRepository->list();
        $this->assertGreaterThan(0, count($items));
    }
}