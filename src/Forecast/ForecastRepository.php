<?php

namespace IanKok\SurfForecastApiClient\Forecast;

use IanKok\SurfForecastApiClient\Client\AuthenticatedSurfForecastClient;
use Psr\Http\Message\ResponseInterface;

class ForecastRepository
{
    /**
     * @var AuthenticatedSurfForecastClient
     */
    protected $client;

    /**
     * @var ForeCastMapper
     */
    protected $resultMapper;

    /**
     * ForecastRepository constructor.
     *
     * @param AuthenticatedSurfForecastClient $client
     * @param ForeCastMapper                  $resultMapper
     */
    public function __construct(AuthenticatedSurfForecastClient $client, ForeCastMapper $resultMapper)
    {
        $this->client       = $client;
        $this->resultMapper = $resultMapper;
    }


    public function get48Hrs($waveBreakSlug)
    {
        $this->client->requestAsync('GET', 'breaks/' . $waveBreakSlug . '/forecasts/latest')->then(
            function (ResponseInterface $response) {

            }
        );
    }


}