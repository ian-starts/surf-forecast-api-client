<?php

namespace IanKok\SurfForecastApiClient\Image;

use GuzzleHttp\Promise\PromiseInterface;
use IanKok\SurfForecastApiClient\Client\AuthenticatedSurfForecastClient;
use IanKok\SurfForecastApiClient\Client\SurfForecastClient;
use IanKok\SurfForecastApiClient\Contracts\IImageMapper;
use IanKok\SurfForecastApiClient\Contracts\IImageRepository;
use Psr\Http\Message\ResponseInterface;

class ImageRepository implements IImageRepository
{
    /**
     * @var AuthenticatedSurfForecastClient
     */
    protected $client;

    /**
     * @var ImageMapper
     */
    protected $resultMapper;

    /**
     * CountryRepository constructor.
     *
     * @param SurfForecastClient $client
     * @param IImageMapper        $resultMapper
     */
    public function __construct(SurfForecastClient $client, ImageMapper $resultMapper)
    {
        $this->client       = $client;
        $this->resultMapper = $resultMapper;
    }

    /**
     * @param string $slug
     *
     * @return array
     */
    public function getByWaveBreakSlug(string $slug): array
    {
        return $this->getByWaveBreakSlugAsync($slug)->wait();
    }

    /**
     * @param string $slug
     *
     * @return PromiseInterface
     */
    public function getByWaveBreakSlugAsync(string $slug): PromiseInterface
    {
        return $this->client->getAsync('/breaks/' . $slug . '/photos')->then(
            function (ResponseInterface $response) use ($slug) {
                return $this->resultMapper->mapResponse($response, $this->client->getConfig('base_uri'), $slug);
            }
        );
    }
}
