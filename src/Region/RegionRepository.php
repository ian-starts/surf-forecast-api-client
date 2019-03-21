<?php

namespace IanKok\SurfForecastApiClient\Region;

use GuzzleHttp\Promise\PromiseInterface;
use IanKok\SurfForecastApiClient\Client\SurfForecastClient;
use IanKok\SurfForecastApiClient\Contracts\IRegionRepository;
use Psr\Http\Message\ResponseInterface;

class RegionRepository implements IRegionRepository
{
    /**
     * @var SurfForecastClient
     */
    protected $client;

    /**
     * @var RegionMapper
     */
    protected $resultMapper;

    /**
     * CountryRepository constructor.
     *
     * @param SurfForecastClient $client
     * @param RegionMapper       $resultMapper
     */
    public function __construct(SurfForecastClient $client, RegionMapper $resultMapper)
    {
        $this->client       = $client;
        $this->resultMapper = $resultMapper;
    }

    public function getByCountryId(string $countyId): array
    {
        return $this->getByCountryIdAsync($countyId)->wait();
    }

    public function getByCountryIdAsync(string $countyId): PromiseInterface
    {
        return $this->client->requestAsync(
            'GET',
            'countries/' . $countyId . '/regions.js'
        )->then(
            function (ResponseInterface $response) {
                return $this->resultMapper->mapResponse($response);
            }
        );
    }
}