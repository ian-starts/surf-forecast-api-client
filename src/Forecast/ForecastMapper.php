<?php


namespace IanKok\SurfForecastApiClient\Forecast;


use IanKok\SurfForecastApiClient\Contracts\IForeCastMapper;
use IanKok\SurfForecastApiClient\Entities\Forecast;
use PHPHtmlParser\Dom;
use Psr\Http\Message\ResponseInterface;

class ForecastMapper  implements IForeCastMapper
{
    /**
     * @var Dom
     */
    protected $domParser;

    /**
     * CountryMapper constructor.
     *
     * @param Dom $domParser
     */
    public function __construct(Dom $domParser) { $this->domParser = $domParser; }

    /**
     * @param ResponseInterface $response
     *
     * @return array | Forecast[]
     */
    public function mapResponse(ResponseInterface $response): array
    {
        $this->domParser->load((string)$response->getBody());
        return $this->map($this->domParser->find('.scrollable-forecast')[0]);
    }

    /**
     * @param Dom\Collection $data
     *
     * @return array | Forecast[]
     */
    public function map(Dom\HtmlNode $data): array
    {
        $days  = $data->find('tr')[0]->find('.day-end');
        // Create all days and hours
        $allDays = array_map(
            function (Dom\HtmlNode $day) use ($days) {
                preg_match('/[0-9]+/', $day->text(), $match);
                $dayNum = (int)$match[0];
                $today = new \DateTimeImmutable();
                $date = $today;
                if ($dayNum == $today->modify('-1 day')->format('d')) {
                    $date = $today->modify('-1 day');
                }
                elseif ($dayNum == $today->modify('-2 days')->format('d')) {
                    $date = $today->modify('-2 days');;
                }
                elseif ($dayNum == $today->modify('+2 days')->format('d')) {
                    $date = $today->modify('+2 days');;
                }
                elseif ($dayNum == $today->modify('+1 day')->format('d')) {
                    $date = $today->modify('+1 day');;
                }
                return array_fill(0, $day->getAttributes()['colspan'], $date);
            },
            $days->toArray()
        );
        // Flatten the array
        $flatSurfDates = array_reduce(
            $allDays,
            function ($carry, $item) {
                return array_merge($carry, $item);
            },
            []
        );
        // Create a timestamp based on the items
        $allTimes      = array_map(
            function ($surfTime, $index) use ($data) {
                $hour    = $data->find('tr')[1]->find('td')[$index];
                $hourInt = (int)$hour->text();
                $ampm    = $hour->find('span')[0]->text();
                if ($ampm === 'PM') {
                    $hourInt = $hourInt + 12;
                }
                return \DateTime::createFromFormat( 'U', mktime($hourInt, 0, 0, $surfTime->format('m'), $surfTime->format('d'), $surfTime->format('Y')));
            },
            $flatSurfDates,
            array_keys($flatSurfDates)
        );

        // Create forecasts from the table
        return array_map(
            function ($surfTime, $index) use ($data) {
                return $this->mapEach($surfTime, $index, $data);
            },
            $allTimes,
            array_keys($allTimes)
        );
    }

    /**
     * @param Dom\HtmlNode $item
     *
     * @return Forecast
     */
    public function mapEach(\DateTime $surfTime, int $index, Dom\HtmlNode $table): Forecast
    {
        $rating        = $table->find('table')[0]->find('tr')[2]->find('td')[$index]->find('img')[0]->getAttributes(
        )['alt'];
        $waveHeight    = $table->find('table')[0]->find('tr')[3]->find('td')[$index]->find('svg')[0]->find('text')[0]->text();
        $waveDirection = $table->find('table')[0]->find('tr')[3]->find('td')[$index]->text();
        $period        = $table->find('table')[0]->find('tr')[4]->find('td')[$index]->text();
        $windSpeed     = $table->find('table')[0]->find('tr')[7]->find('td')[$index]->find('svg')->find('text')[0]->text();
        $windDirection = $table->find('table')[0]->find('tr')[7]->find('td')[$index]->text();
        $windState     = $table->find('table')[0]->find('tr')[8]->find('td')[$index]->find('b')[0]->text();
        $tide          = $table->find('table')[0]->find('tr')[9]->find('td')[$index]->text();

        return new Forecast(
            $surfTime,
            $rating,
            $waveHeight,
            $waveDirection,
            $period,
            $windSpeed,
            $windDirection,
            $windState,
            $tide
        );
    }
}