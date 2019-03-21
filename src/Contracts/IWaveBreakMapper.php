<?php

namespace IanKok\SurfForecastApiClient\Contracts;

use Psr\Http\Message\ResponseInterface;

interface IWaveBreakMapper
{
    public function mapResponse(ResponseInterface $response, string $region): array;
}