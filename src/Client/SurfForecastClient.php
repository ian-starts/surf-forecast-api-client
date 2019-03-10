<?php

namespace IanKok\SurfForecastApiClient\Client;

use GuzzleHttp\Client;

class SurfForecastClient extends Client implements AuthenticatedSurfForecastClient
{
    /**
     * SurfForecastClient constructor.
     *
     * @param string    $base
     * @param array     $config
     */
    public function __construct(
        string $base,
        array $config = []
    ) {
        $config = array_merge(
            $config,
            [
                'base_uri' => $base
            ]
        );

        parent::__construct($config);
    }
}