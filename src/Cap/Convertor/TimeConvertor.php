<?php

namespace Cap\Convertor;

class TimeConvertor
{
    /**
     * @param string $time
     *
     * @return float
     */
    public function getTimeToHour($time)
    {
        $timeArray = explode(':', $time);
        return ceil($timeArray[0])
            + ((($timeArray[1] * 100) / 60) / 100)
            + ((($timeArray[2] * 100) / 60) / 100) * 100 / 60 / 100
            ;
    }

    /**
     * @param float
     *
     * @return array
     */
    public function getHourToTime($timeToHour)
    {
        $time = array();

        $hour = floor($timeToHour);
        $min = floor(($timeToHour - $hour) * 60);
        $sec = floor(((($timeToHour - $hour) * 60) - $min) * 60);

        $time['hh'] = str_pad($hour, 2, '0', STR_PAD_LEFT);
        $time['mm'] = str_pad($min, 2, '0', STR_PAD_LEFT);
        $time['ss'] = str_pad($sec,  2, '0', STR_PAD_LEFT);

        return $time;
    }
}
