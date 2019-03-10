<?php

namespace IanKok\SurfForecastApiClient\Country;

use GuzzleHttp\Promise\PromiseInterface;
use IanKok\SurfForecastApiClient\Client\SurfForecastClient;
use IanKok\SurfForecastApiClient\Entities\Country;
use Psr\Http\Message\ResponseInterface;

class CountryRepository
{
    /**
     * @var SurfForecastClient
     */
    protected $client;

    /**
     * @var CountryMapper
     */
    protected $resultMapper;

    /**
     * CountryRepository constructor.
     *
     * @param SurfForecastClient $client
     * @param CountryMapper      $resultMapper
     */
    public function __construct(SurfForecastClient $client, CountryMapper $resultMapper)
    {
        $this->client       = $client;
        $this->resultMapper = $resultMapper;
    }

    /**
     * @return array | Country[]
     */
    public function list(): array
    {
        return $this->listAsync()->wait();
    }

    public function listAsync(): PromiseInterface
    {
        return $this->client->requestAsync(
            'GET',
            ''
        )->then(
            function (ResponseInterface $response) {
                return $this->resultMapper->mapResponse($response);
            }
        );
    }
}