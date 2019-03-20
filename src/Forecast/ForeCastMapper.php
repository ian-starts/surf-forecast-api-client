<?php


namespace IanKok\SurfForecastApiClient\Forecast;


use IanKok\SurfForecastApiClient\Entities\Forecast;
use PHPHtmlParser\Dom;
use Psr\Http\Message\ResponseInterface;

class ForeCastMapper
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
        return $this->map($this->domParser->find('#country_id')[0]->find('option'));
    }

    /**
     * @param Dom\Collection $data
     *
     * @return array | Forecast[]
     */
    public function map(Dom\Collection $data): array
    {
        $arrayList = [];
        foreach ($data as $element) {
            $arrayList[] = $this->mapEach($element);
        }
        return $arrayList;
    }

    /**
     * @param Dom\HtmlNode $item
     *
     * @return Forecast
     */
    public function mapEach(Dom\HtmlNode $item): Forecast
    {
        return new Forecast();
    }
}