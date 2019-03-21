<?php

namespace IanKok\SurfForecastApiClient\Region;

use IanKok\SurfForecastApiClient\Contracts\IRegionMapper;
use IanKok\SurfForecastApiClient\Entities\Region;
use PHPHtmlParser\Dom;
use Psr\Http\Message\ResponseInterface;

class RegionMapper implements IRegionMapper
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
     * @return Region
     */
    public function mapEach(Dom\HtmlNode $item): Region
    {
        return new Region($item->text(), $item->getAttribute('value'));
    }
}