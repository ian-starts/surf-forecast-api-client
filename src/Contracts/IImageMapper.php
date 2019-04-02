<?php

namespace IanKok\SurfForecastApiClient\Contracts;

use IanKok\SurfForecastApiClient\Entities\Image;
use Psr\Http\Message\ResponseInterface;

interface IImageMapper
{
    /**
     * @param ResponseInterface $response
     *
     * @return array | Image[]
     */
    public function mapResponse(ResponseInterface $response, string $baseUrl, string $slug): array;
}
