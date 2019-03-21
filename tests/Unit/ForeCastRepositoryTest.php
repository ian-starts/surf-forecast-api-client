<?php

namespace  IanKok\SurfForecastApiClient\Test\Unit;

use IanKok\SurfForecastApiClient\Forecast\ForeCastMapper;
use IanKok\SurfForecastApiClient\Forecast\ForecastRepository;
use IanKok\SurfForecastApiClient\Test\TestCase;
use IanKok\SurfForecastApiClient\Test\TestLib\FakeClients\FakeSurfForecastClient;
use PHPHtmlParser\Dom;

class ForeCastRepositoryTest extends TestCase
{
    protected $client;

    protected $foreCastRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->client = new FakeSurfForecastClient('/');
        $this->foreCastRepository = new ForecastRepository($this->client, new ForeCastMapper(new Dom()));
    }

    /**
     * @test
     */
    public function itCanList48HrsForecast()
    {
        $items = $this->foreCastRepository->get48Hrs('Canggu');
        $this->assertGreaterThan(0, count($items));
    }
}