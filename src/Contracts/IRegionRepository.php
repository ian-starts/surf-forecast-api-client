<?php

namespace IanKok\SurfForecastApiClient\Contracts;

use GuzzleHttp\Promise\PromiseInterface;

interface IRegionRepository
{
    public function getByCountryId(string $countyId): array;

    public function getByCountryIdAsync(string $countyId): PromiseInterface;
}