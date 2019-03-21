<?php

namespace IanKok\SurfForecastApiClient\Contracts;

use GuzzleHttp\Promise\PromiseInterface;

interface ICountryRepository
{
    public function list(): array;

    public function listAsync(): PromiseInterface;
}