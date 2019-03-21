# Surf Forecast Api Client

A php Library for fetching wavebreak information from [surf-forecast](http://www.surf-forecast.com/).

## Installation

`composer require iankok/surf-forecast-api-client`
## Features
- Fully async so blazing fast
- Search by country
- Service provider to be able to use in Laravel
- Everything is poured in DDD design. So every call returns an array of typed classes. If you need different variables: feel free to make a PR or fork.

## Samples
It's should be very easy use and implement in Laravel. Make sure you add 
`IanKok\SurfForecastApiClient\SurfForecastApiClientServiceProvider:class,`
to your `app.php` under `providers`;

The final sample is how you should leverage the async functionality of this package.

```php
// Get the 48 hrs forcast for canggu
$client = new SurfForecastClient('http://www.surf-forecast.com/');
$forecastRepository = new ForecastRepository($client, new ForecastMapper());
$forecastRepository->get48HrsAsync('Canggu')->wait();


// Get all available Countries
$countryRepository = new CountryRepository($client, new CountryMapper());
$countryRepository->listAsync()->wait();

// Get all wavebreaks by country id and their forecasts
$waveBreakRepository = new WaveBreakRepositoryAdapter(
    new WaveBreakMapper(new Dom()),
    new RegionMapper(new Dom()),
    $client,
    new ResponseInterpreter()
);
$waveBreaks = $waveBreakRepository->getByCountryIdAsync('213')->wait()
$foreCasts = array_map(function ($waveBreak) {
        return $forecastRepository->get48HrsAsync($waveBreak->getSlug);
    },$waveBreaks
)
all($foreCasts)->wait();
$foreCasts = array_map(function ($waveBreak) {
    return $waveBreak->wait();
    }, $waveBreaks
)
```