<?php

namespace IanKok\SurfForecastApiClient;

use IanKok\SurfForecastApiClient\Client\AuthenticatedSurfForecastClient;
use IanKok\SurfForecastApiClient\Client\SurfForecastClient;
use IanKok\SurfForecastApiClient\Contracts\IWaveBreakRepositoryAdapter;
use IanKok\SurfForecastApiClient\Image\ImageMapper;
use IanKok\SurfForecastApiClient\Image\ImageRepository;
use IanKok\SurfForecastApiClient\Region\RegionMapper;
use IanKok\SurfForecastApiClient\WaveBreak\ResponseInterpreter;
use IanKok\SurfForecastApiClient\WaveBreak\WaveBreakMapper;
use IanKok\SurfForecastApiClient\WaveBreak\WaveBreakRepositoryAdapter;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use PHPHtmlParser\Dom;

class SurfForecastApiClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            AuthenticatedSurfForecastClient::class,
            function (Application $app) {
                return new SurfForecastClient(
                    'http://www.surf-forecast.com/'
                );
            }
        );

        $this->app->bind(
            IWaveBreakRepositoryAdapter::class,
            function (Application $app) {
                return new WaveBreakRepositoryAdapter(
                    new WaveBreakMapper(
                        new Dom(),
                        new ImageRepository(
                            $app[AuthenticatedSurfForecastClient::class],
                            new ImageMapper(new Dom())
                        )
                    ),
                    new RegionMapper(new Dom()),
                    $app[AuthenticatedSurfForecastClient::class],
                    new ResponseInterpreter()
                );
            }
        );
    }
}
