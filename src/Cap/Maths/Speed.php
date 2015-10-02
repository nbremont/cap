<?php

namespace Cap\Maths;

use Cap\Convertor\TimeConvertor;

class Speed
{
    /**
     * Distance in meters
     *
     * @var float
     */
    private $distance;

    /**
     * Time in hh:mm:ss
     *
     * @var float
     */
    private $time;

    /**
     * Speed in km/h
     *
     * @var float
     */
    private $speed;

    /**
     * @var TimeConvertor
     */
    private $convertor;

    /**
     * @param float $distance
     * @param float $time
     * @param float $speed
     */
    public function __construct($distance = null, $time = null, $speed = null, $convertor)
    {
        $this->distance = $distance;
        $this->time = $time;
        $this->speed = $speed;
        $this->convertor = $convertor;
    }

    /**
     * Get Vitesse V (km/h) = D/t
     *
     * @return float
     */
    public function getV()
    {
        return round($this->distance / $this->convertor->getTimeToHour($this->time), 2);
    }

    /**
     * Get Distance D (km) = V*t
     *
     * @return float
     */
    public function getD()
    {
        return $this->speed * $this->time;
    }

    /**
     * Get Time t (hh:mm:ss) = D/V
     *
     * @return float
     */
    public function getT()
    {
        $timeArray = $this->convertor->getHourToTime($this->distance / $this->speed);
        return implode(':', $timeArray);
    }

    /**
     * @return float
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param float $distance
     *
     * @return Speed
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * @return float
     */
    public function getTime()
    {
        $this->time;
    }

    /**
     * @param float $time
     *
     * @return Speed
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return float
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param float $speed
     *
     * @return Speed
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }
}
