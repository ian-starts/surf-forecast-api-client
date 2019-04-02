<?php

namespace IanKok\SurfForecastApiClient\Entities;

class WaveBreak
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $regionName;

    /**
     * @var array | Image[]
     */
    protected $images;

    /**
     * WaveBreak constructor.
     *
     * @param string $name
     * @param string $slug
     * @param string $regionName
     * @param array  $images
     */
    public function __construct(string $name, string $slug, string $regionName, array $images)
    {
        $this->name       = $name;
        $this->slug       = $slug;
        $this->regionName = $regionName;
        $this->images     = $images;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string | Image[]
     */
    public function getImages(): string
    {
        return $this->images;
    }

    /**
     * @return string
     */
    public function getRegionName(): string
    {
        return $this->regionName;
    }

}
