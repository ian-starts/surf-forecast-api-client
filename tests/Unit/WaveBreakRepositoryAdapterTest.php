<?php


namespace IanKok\SurfForecastApiClient\Test\Unit;


use IanKok\SurfForecastApiClient\Region\RegionMapper;
use IanKok\SurfForecastApiClient\Test\TestCase;
use IanKok\SurfForecastApiClient\Test\TestLib\FakeClients\FakeSurfForecastClient;
use IanKok\SurfForecastApiClient\WaveBreak\ResponseInterpreter;
use IanKok\SurfForecastApiClient\WaveBreak\WaveBreakMapper;
use IanKok\SurfForecastApiClient\WaveBreak\WaveBreakRepositoryAdapter;
use PHPHtmlParser\Dom;

class WaveBreakRepositoryAdapterTest extends TestCase
{

    protected $client;

    protected $waveBreakRepositoryAdapter;

    protected function setUp()
    {
        parent::setUp();

        $this->client                     = new FakeSurfForecastClient('/');
        $this->waveBreakRepositoryAdapter = new WaveBreakRepositoryAdapter(
            new WaveBreakMapper(new Dom()),
            new RegionMapper(new Dom()),
            $this->client,
            new ResponseInterpreter()
        );
    }

    /**
     * @test
     */
    public function itCanListWaveBreaksFromNestedCall()
    {
        $waveBreakData              = $this->waveBreakRepositoryAdapter->getByCountryId('213');
        $this->assertGreaterThan(0, count($waveBreakData));

    }

    /**
     * @test
     */
    public function itCanListWaveBreaksFromFlatCall()
    {
        $waveBreakData              = $this->waveBreakRepositoryAdapter->getByCountryId('377');
        $this->assertGreaterThan(0, count($waveBreakData));

    }
}