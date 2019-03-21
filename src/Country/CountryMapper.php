<?php

namespace IanKok\SurfForecastApiClient\Country;

use IanKok\SurfForecastApiClient\Contracts\ICountryMapper;
use IanKok\SurfForecastApiClient\Entities\Country;
use PHPHtmlParser\Dom;
use Psr\Http\Message\ResponseInterface;

class CountryMapper implements ICountryMapper
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
     * @return array | Country[]
     */
    public function mapResponse(ResponseInterface $response): array
    {
        $this->domParser->load((string)$response->getBody());
        return $this->map($this->domParser->find('#country_id')[0]->find('option'));
    }

    /**
     * @param Dom\Collection $data
     *
     * @return array | Country[]
     */
    public function map(Dom\Collection $data): array
    {
        return array_map(
            function ($element) {
                return $this->mapEach($element);
            },
            array_filter(
                $data->toArray(),
                function ($element) {
                    return $element->text() !== 'Choose';
                }
            )
        );
    }

    /**
     * @param Dom\HtmlNode $item
     *
     * @return Country
     */
    public function mapEach(Dom\HtmlNode $item): Country
    {
        return new Country($item->text(), $item->getAttribute('value'));
    }
}