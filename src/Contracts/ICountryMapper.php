<?php

namespace IanKok\SurfForecastApiClient\Contracts;

use Psr\Http\Message\ResponseInterface;

interface ICountryMapper
{
    public function mapResponse(ResponseInterface $response): array;
}