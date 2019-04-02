<?php


namespace IanKok\SurfForecastApiClient\Image;


use IanKok\SurfForecastApiClient\Contracts\IImageMapper;
use IanKok\SurfForecastApiClient\Entities\Image;
use PHPHtmlParser\Dom;
use Psr\Http\Message\ResponseInterface;

class ImageMapper implements IImageMapper
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
     * @return array | Image[]
     */
    public function mapResponse(ResponseInterface $response, string $baseUrl, string $slug): array
    {
        $this->domParser->load((string)$response->getBody());
        $data = $this->domParser->find('div[class=\'gallery photos\']')->toArray();
        return $this->map(
            end($data)->find('ul')[0]->find('li'),
            $baseUrl,
            $slug
        );
    }

    /**
     * @param Dom\Collection $data
     *
     * @return array | Image[]
     */
    private function map(Dom\Collection $data, string $baseUrl, string $slug): array
    {
        return array_map(
            function ($element) use ($baseUrl, $slug) {
                return $this->mapEach($element, $baseUrl, $slug);
            },
            $data->toArray()
        );
    }

    /**
     * @param Dom\HtmlNode $item
     *
     * @return Image
     */
    private function mapEach(Dom\HtmlNode $item, string $baseUrl, string $slug): Image
    {
        $imageUrl = explode('/', $item->find('a')[0]->getAttribute('href'));
        return new Image(
            $baseUrl . 'system/images/' . end(
                $imageUrl
            ) . '/large/' . $slug . '.jpg'
        );
    }
}
