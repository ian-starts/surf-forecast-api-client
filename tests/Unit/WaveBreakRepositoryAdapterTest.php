<?php


namespace IanKok\SurfForecastApiClient\Test\Unit;


use IanKok\SurfForecastApiClient\Client\SurfForecastClient;
use IanKok\SurfForecastApiClient\Region\RegionMapper;
use IanKok\SurfForecastApiClient\Test\TestCase;
use IanKok\SurfForecastApiClient\WaveBreak\ResponseInterpreter;
use IanKok\SurfForecastApiClient\WaveBreak\WaveBreakMapper;
use IanKok\SurfForecastApiClient\WaveBreak\WaveBreakRepositoryAdapter;
use PHPHtmlParser\Dom;

class WaveBreakRepositoryAdapterTest extends TestCase
{
    /**
     * @test
     */
    public function itCanListWaveBreaks()
    {
        $client = new SurfForecastClient('http://www.surf-forecast.com/');
        $waveBreakMapper = new WaveBreakMapper(new Dom());
        $regionMapper = new RegionMapper(new Dom());
        $waveBreakRepositoryAdapter = new WaveBreakRepositoryAdapter($waveBreakMapper, $regionMapper, $client, new ResponseInterpreter());
        $waveBreakData = $waveBreakRepositoryAdapter->getByCountryId('213');
        var_dump($waveBreakData);

    }
}