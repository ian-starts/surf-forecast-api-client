<?php

namespace IanKok\SurfForecastApiClient\Contracts;

use GuzzleHttp\Promise\PromiseInterface;

interface IForeCastRepository
{
    public function get48Hrs(string $wavebreak): array ;

    public function get48HrsAsync(string $waveBreakSlug): PromiseInterface;
}