<?php

namespace IanKok\SurfForecastApiClient\Contracts;

use GuzzleHttp\Promise\PromiseInterface;

interface IWaveBreakRepositoryAdapter
{
    public function getByCountryId(string $countyId): array;

    public function getByCountryIdAsync(string $countyId): PromiseInterface;
}