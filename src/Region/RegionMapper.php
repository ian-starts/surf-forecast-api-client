<?php

namespace IanKok\SurfForecastApiClient\Region;

use IanKok\SurfForecastApiClient\Entities\Country;
use IanKok\SurfForecastApiClient\Entities\Region;
use IanKok\SurfForecastApiClient\Entities\WaveBreak;
use PHPHtmlParser\Dom;
use Psr\Http\Message\ResponseInterface;

class RegionMapper
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
     * @return array | Region[]
     */
    public function mapResponse(ResponseInterface $response): array
    {
        $this->domParser->load((string)$response->getBody());
        return $this->map($this->domParser->find('#region_id')[0]->find('option'));
    }

    /**
     * @param Dom\Collection $data
     *
     * @return array | Region[]
     */
    public function map(Dom\Collection $data): array
    {
        $arrayList = [];
        foreach ($data as $element) {
            if ($element->text() === 'Choose') {
                continue;
            }
            $arrayList[] = $this->mapEach($element);
        }
        return $arrayList;
    }

    /**
     * @param Dom\HtmlNode $item
     *
     * @return Region
     */
    public function mapEach(Dom\HtmlNode $item): Region
    {
        return new Region($item->text(), $item->getAttribute('value'));
    }
}