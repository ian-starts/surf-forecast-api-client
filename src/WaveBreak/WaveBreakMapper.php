<?php

namespace IanKok\SurfForecastApiClient\WaveBreak;

use IanKok\SurfForecastApiClient\Entities\WaveBreak;
use PHPHtmlParser\Dom;
use Psr\Http\Message\ResponseInterface;

class WaveBreakMapper implements \IanKok\SurfForecastApiClient\Contracts\WaveBreakMapper
{
    /**
     * @var Dom
     */
    protected $domParser;

    /**
     * WaveBreakMapper constructor.
     *
     * @param Dom $domParser
     */
    public function __construct(Dom $domParser) { $this->domParser = $domParser; }


    /**
     * @param ResponseInterface $response
     * @param string            $region
     *
     * @return array | WaveBreak[]
     */
    public function mapResponse(ResponseInterface $response, string $region): array
    {
        $this->domParser->load((string)$response->getBody());

        return $this->map($this->domParser->find('#location_filename_part')[0]->find('option'), $region);
    }

    /**
     * @param Dom\Collection $data
     *
     * @param string         $region
     *
     * @return array | WaveBreak[]
     */
    public function map(Dom\Collection $data, string $region): array
    {
        $arrayList = [];
        foreach ($data as $element) {
            if ($element->text() === 'Choose') {
                continue;
            }
            $arrayList[] = $this->mapEach($element, $region);
        }
        return $arrayList;
    }

    /**
     * @param Dom\HtmlNode $item
     *
     * @param string       $region
     *
     * @return WaveBreak
     */
    public function mapEach(Dom\HtmlNode $item, string $region): WaveBreak
    {
        return new WaveBreak($item->text(), $item->getAttribute('value'), $region);
    }
}