<?php

namespace IanKok\SurfForecastApiClient\Contracts;

use Psr\Http\Message\ResponseInterface;

interface IRegionMapper
{
    public function mapResponse(ResponseInterface $response): array;
}