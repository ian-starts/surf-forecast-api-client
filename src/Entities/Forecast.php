<?php


namespace IanKok\SurfForecastApiClient\Entities;


class Forecast
{
    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var int
     */
    protected $rating;

    /**
     * @var float
     */
    protected $waveHeight;

    /**
     * @var string
     */
    protected $waveDirection;

    /**
     * @var int
     */
    protected $period;

    /**
     * @var int
     */
    protected $windSpeed;

    /**
     * @var string
     */
    protected $windDirection;

    /**
     * @var string
     */
    protected $windState;

    /**
     * @var string
     */
    protected $tide;

    /**
     * Forecast constructor.
     *
     * @param \DateTime $date
     * @param int       $rating
     * @param float     $waveHeight
     * @param string    $waveDirection
     * @param int       $period
     * @param int       $windSpeed
     * @param string    $windDirection
     * @param string    $windState
     * @param string    $tide
     */
    public function __construct(
        \DateTime $date,
        int $rating,
        float $waveHeight,
        string $waveDirection,
        int $period,
        int $windSpeed,
        string $windDirection,
        string $windState,
        string $tide
    ) {
        $this->date          = $date;
        $this->rating        = $rating;
        $this->waveHeight    = $waveHeight;
        $this->waveDirection = $waveDirection;
        $this->period        = $period;
        $this->windSpeed     = $windSpeed;
        $this->windDirection = $windDirection;
        $this->windState     = $windState;
        $this->tide          = $tide;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @return float
     */
    public function getWaveHeight(): float
    {
        return $this->waveHeight;
    }

    /**
     * @return string
     */
    public function getWaveDirection(): string
    {
        return $this->waveDirection;
    }

    /**
     * @return int
     */
    public function getPeriod(): int
    {
        return $this->period;
    }

    /**
     * @return int
     */
    public function getWindSpeed(): int
    {
        return $this->windSpeed;
    }

    /**
     * @return string
     */
    public function getWindDirection(): string
    {
        return $this->windDirection;
    }

    /**
     * @return string
     */
    public function getWindState(): string
    {
        return $this->windState;
    }

    /**
     * @return string
     */
    public function getTide(): string
    {
        return $this->tide;
    }


}