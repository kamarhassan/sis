<?php

namespace App\Traits;

use DateTime;
use DatePeriod;
use DateInterval;

trait DateRangeTraits
{
    function get_days_between_two_date($starts_date,$end_date)
    {   
        $begin = new DateTime($starts_date);
        $end = new DateTime($end_date);
        $end = $end->modify('+1 day');
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval, $end);
        $date_range = [];
        $dates = [];
        foreach ($daterange as $date) {
            $date = $date->format("Y-m-d");
            $dates[]=$date;
            $date_range[$date] =  date('l', strtotime($date));
        }
        return ['days'=>$date_range,'dates'=>$dates];
    }
}
