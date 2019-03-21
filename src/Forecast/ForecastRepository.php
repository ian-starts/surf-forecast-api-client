<?php

namespace IanKok\SurfForecastApiClient\Forecast;

use GuzzleHttp\Promise\PromiseInterface;
use IanKok\SurfForecastApiClient\Client\AuthenticatedSurfForecastClient;
use IanKok\SurfForecastApiClient\Contracts\IForeCastMapper;
use IanKok\SurfForecastApiClient\Contracts\IForeCastRepository;
use Psr\Http\Message\ResponseInterface;

class ForecastRepository implements IForeCastRepository
{
    /**
     * @var AuthenticatedSurfForecastClient
     */
    protected $client;

    /**
     * @var ForecastMapper
     */
    protected $resultMapper;

    /**
     * ForecastRepository constructor.
     *
     * @param AuthenticatedSurfForecastClient $client
     * @param ForecastMapper                  $resultMapper
     */
    public function __construct(AuthenticatedSurfForecastClient $client, ForecastMapper $resultMapper)
    {
        $this->client       = $client;
        $this->resultMapper = $resultMapper;
    }

    public function get48Hrs(string $waveBreakSlug): array
    {
        return $this->get48HrsAsync($waveBreakSlug)->wait();
    }

    public function get48HrsAsync(string $waveBreakSlug): PromiseInterface
    {
        return $this->client->requestAsync('GET', 'breaks/' . $waveBreakSlug . '/forecasts/latest')->then(
            function (ResponseInterface $response) {
                return $this->resultMapper->mapResponse($response);
            }
        );
    }

}