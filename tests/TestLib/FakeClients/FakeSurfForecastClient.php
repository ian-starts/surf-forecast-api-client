<?php

namespace IanKok\SurfForecastApiClient\Test\TestLib\FakeClients;

use EventsTravel\AFASSDK\Client\AFASClient;
use EventsTravel\AFASSDK\Client\AFASInsertedResponse;
use EventsTravel\AFASSDK\Client\AFASQueryFactory;
use EventsTravel\AFASSDK\Client\AFASResponse;
use IanKok\SurfForecastApiClient\Client\SurfForecastClient;

class FakeSurfForecastClient extends SurfForecastClient
{
    protected $fakeClient;
    protected $queryFactory;
    protected $paths = [
        'GET' => [
            '/'
            => 'tests/Data/homepage.html',
            '/breaks/Canggu/forecasts/latest'
            => 'tests/Data/canggu_48hrs_forecast.html',
            '/countries/213/regions.js'
            => 'tests/Data/region.html',
            '/countries/377/regions.js'
            => 'tests/Data/wavebreaks.html',
            '/regions/1935/breaks.js'
            => 'tests/Data/wavebreaks.html',
            '/breaks/Digger/photos'
            => 'tests/Data/images.html',
        ],

    ];

    public function __construct(string $baseUrl, array $config = [])
    {
        parent::__construct($baseUrl, $config);

        $this->fakeClient = new FakeGuzzleClient($this->getConfig(), $this->paths);
    }

    public function request($method, $uri = '', array $options = [])
    {
        return $this->requestAsync($method, $uri, $options)->wait();
    }

    public function requestAsync($method, $uri = '', array $options = [])
    {
        return $this->fakeClient->requestAsync($method, $uri, $options);
    }
}
