<?php

namespace  IanKok\SurfForecastApiClient\Test\Unit;

use IanKok\SurfForecastApiClient\Image\ImageMapper;
use IanKok\SurfForecastApiClient\Image\ImageRepository;
use IanKok\SurfForecastApiClient\Test\TestCase;
use IanKok\SurfForecastApiClient\Test\TestLib\FakeClients\FakeSurfForecastClient;
use IanKok\SurfForecastApiClient\WaveBreak\WaveBreakMapper;
use IanKok\SurfForecastApiClient\WaveBreak\WaveBreakRepository;
use PHPHtmlParser\Dom;

class WaveBreakRepositoryTest extends TestCase
{
    protected $client;

    protected $waveBreakRepository;

    protected $imageRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->client                     = new FakeSurfForecastClient('/');
        $this->imageRepository            = new ImageRepository($this->client, new ImageMapper(new Dom()));
        $this->waveBreakRepository = new WaveBreakRepository(
            $this->client,
            new WaveBreakMapper(new Dom(), $this->imageRepository)
        );
    }
    /**
     * @test
     */
    public function itCanListWaveBreaks()
    {
        $waveBreakData =$this->waveBreakRepository->getByRegionId('1935', 'test');
        $this->assertGreaterThan(0, count($waveBreakData));
    }
}
