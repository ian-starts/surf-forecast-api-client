<?php
namespace IanKok\SurfForecastApiClient\WaveBreak;

use Psr\Http\Message\ResponseInterface;

class ResponseInterpreter
{
    const CLASSMAPPERS =
        [
            'region',
            'wavebreak'
        ];

    public function interpret(ResponseInterface $response)
    {
        if (strpos((string)$response->getBody(), 'region_id'))
        {
            return self::CLASSMAPPERS[0];
        }
        return self::CLASSMAPPERS[1];
    }
}