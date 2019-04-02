<?php

namespace IanKok\SurfForecastApiClient\Contracts;

use GuzzleHttp\Promise\PromiseInterface;

interface IImageRepository
{
    public function getByWaveBreakSlug(string $slug): array;

    public function getByWaveBreakSlugAsync(string $slug): PromiseInterface;
}
