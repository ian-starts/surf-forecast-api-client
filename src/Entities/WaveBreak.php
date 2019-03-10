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
     * WaveBreak constructor.
     *
     * @param string $name
     * @param string $slug
     * @param string $regionName
     */
    public function __construct(string $name, string $slug, string $regionName)
    {
        $this->name       = $name;
        $this->slug       = $slug;
        $this->regionName = $regionName;
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
     * @return string
     */
    public function getRegionName(): string
    {
        return $this->regionName;
    }

}