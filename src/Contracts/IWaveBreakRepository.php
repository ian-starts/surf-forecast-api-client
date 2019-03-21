<?php

namespace IanKok\SurfForecastApiClient\Contracts;

use GuzzleHttp\Promise\PromiseInterface;

interface IWaveBreakRepository
{
    public function getByRegionId(string $countyId, string $region): array;

    public function getByRegionIdAsync(string $countyId, string $region): PromiseInterface;
}