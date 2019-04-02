<?php

namespace  IanKok\SurfForecastApiClient\Test\Unit;


use IanKok\SurfForecastApiClient\Image\ImageMapper;
use IanKok\SurfForecastApiClient\Image\ImageRepository;
use IanKok\SurfForecastApiClient\Test\TestCase;
use IanKok\SurfForecastApiClient\Test\TestLib\FakeClients\FakeSurfForecastClient;
use PHPHtmlParser\Dom;

class ImageRepositoryTest extends TestCase
{

    protected $client;

    /**
     * @var ImageRepository
     */
    protected $imageRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->client = new FakeSurfForecastClient('');
        $this->imageRepository = new ImageRepository($this->client, new ImageMapper(new Dom()));
    }

    /**
     * @test
     */
    public function itCanListImages()
    {
        $items = $this->imageRepository->getByWaveBreakSlugAsync('Digger')->wait();
        $this->assertGreaterThan(0, count($items));
    }
}
