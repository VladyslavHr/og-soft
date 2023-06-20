<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\CzHoliday;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');



Artisan::command('testt', function(){

    $date = '05-07-2023';

    $date = Carbon\Carbon::parse($date)->format('Y-m-d');

    // dd($date);
    $holidays = CzHoliday::get()->toArray();

    // dd($holidays);
    dump($date);
    $holidays_arr = [];
    foreach ($holidays as $key => $holiday) {
        $holidays_arr[] = $holiday['date'];


    }
    dump($holidays_arr);
    $res = in_array($date, $holidays_arr);

    dd($res);
    // return in_array($date, $holidays['date']);

});
