<?php

namespace App\Services;
use Illuminate\Support\ServiceProvider;
use App\Models\CzHoliday;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class Date extends ServiceProvider
{

    public static function checkDate() {


        $date = 'date';

        return $date;

    }


    public static function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }

    public static function isHoliday($date)
    {
        $holidays = [
            '01-01-2023',
            '07-04-2023',
            '10-04-2023',
            '01-05-2023',
            '03-05-2023',
            '08-05-2023',
            '05-07-2023',
            '06-07-2023',
            '28-09-2023',
            '28-10-2023',
            '17-11-2023',
            '24-12-2023',
            '25-12-2023',
            '26-12-2023',
        ];

        return in_array($date, $holidays);
    }

    public static function isWorkDays($date)
    {
        $wokDays = [2,3,4,5];
        $requestDate = date('N', strtotime($date));
        return ( in_array($requestDate, $wokDays));
    }
}
