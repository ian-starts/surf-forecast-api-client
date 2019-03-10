<?php

namespace IanKok\SurfForecastApiClient\WaveBreak;

use GuzzleHttp\Promise\PromiseInterface;
use IanKok\SurfForecastApiClient\Client\SurfForecastClient;
use IanKok\SurfForecastApiClient\Region\RegionRepository;
use Psr\Http\Message\ResponseInterface;

class WaveBreakRepository
{
    /**
     * @var SurfForecastClient
     */
    protected $client;

    /**
     * @var WaveBreakMapper
     */
    protected $resultMapper;

    /**
     * @var
     */
    protected $regionRepository;

    /**
     * WaveBreakRepository constructor.
     *
     * @param SurfForecastClient $client
     * @param WaveBreakMapper    $resultMapper
     * @param RegionRepository   $regionRepository
     */
    public function __construct(SurfForecastClient $client, WaveBreakMapper $resultMapper)
    {
        $this->client       = $client;
        $this->resultMapper = $resultMapper;
    }

    public function getByRegionId(string $countyId, string $region): array
    {
        return $this->getByRegionIdAsync($countyId, $region)->wait();
    }

    public function getByRegionIdAsync(string $countyId, string $region): PromiseInterface
    {
        return $this->client->requestAsync(
            'GET',
            'http://www.surf-forecast.com/regions/' . $countyId . '/breaks.js'
        )->then(
            function (ResponseInterface $response) use ($region) {
                return $this->resultMapper->mapResponse($response, $region);
            }
        );
    }
}