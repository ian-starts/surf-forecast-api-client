<?php


namespace IanKok\SurfForecastApiClient\Entities;


class Image
{
    protected $url;

    /**
     * Image constructor.
     *
     * @param $url
     */
    public function __construct($url) { $this->url = $url; }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }


}
