<?php


namespace IanKok\SurfForecastApiClient\Test\Unit;


use IanKok\SurfForecastApiClient\Client\SurfForecastClient;
use IanKok\SurfForecastApiClient\Region\RegionMapper;
use IanKok\SurfForecastApiClient\Test\TestCase;
use IanKok\SurfForecastApiClient\WaveBreak\ResponseInterpreter;
use IanKok\SurfForecastApiClient\WaveBreak\WaveBreakMapper;
use IanKok\SurfForecastApiClient\WaveBreak\WaveBreakRepository;
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
        $waveBreakRepository = new WaveBreakRepository($client, $waveBreakMapper);
        $regionMapper = new RegionMapper(new Dom());
        $waveBreakRepositoryAdapter = new WaveBreakRepositoryAdapter($waveBreakRepository, $waveBreakMapper, $regionMapper, $client, new ResponseInterpreter());
        $waveBreakData = $waveBreakRepositoryAdapter->getByCountryId('213');
        var_dump($waveBreakData);

    }
}