<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Holiday, Country};
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;

class GeneralOneController extends Controller
{
    public function index() {
        return view('general.one');
    }

    public function dateFilter(Request $request)
    {
        $date = $request->date;
        $time = $request->time;
        $duration = $request->duration;
        $country = $request->country;

        $date = Carbon::parse($date)->format('Y-m-d');
        $time = Carbon::parse($time)->format('H:i:s');

        if ($date === null) {
            return[
                'status' => 'ok',
                'date' => 'Prosím vyberte datum!',
                'date_view' => '<h3 class="text-center py-5 notify-stops-text">Prosím vyberte datum!</h3>',
            ];
        }

        if ($time === null) {
            return[
                'status' => 'ok',
                'date' => 'Prosím vyberte čas!',
                'date_view' => '<h3 class="text-center py-5 notify-stops-text">Prosím vyberte čas!</h3>',
            ];
        }

        if ($duration === null) {
            return[
                'status' => 'ok',
                'date' => 'Prosím zadejte delku v minutech!',
                'date_view' => '<h3 class="text-center py-5 notify-stops-text">Prosím zadejte delku v minutech!</h3>',
            ];
        }

        if ($country == 3 && ($time < '09:00:00' || $time > '16:00:00')) {
            return[
                'status' => 'ok',
                'date' => 'Mimopracovní doba. Pracovní doba od 09:00 do 16:00',
                'date_view' => '<h3 class="text-center py-5 notify-stops-text">Mimopracovní doba. Pracovní doba od 09:00 do 16:00</h3>',
            ];
        }elseif ($time < '09:00:00' || $time > '17:00:00') {
            return[
                'status' => 'ok',
                'date' => 'Mimopracovní doba. Pracovní doba od 09:00 do 17:00',
                'date_view' => '<h3 class="text-center py-5 notify-stops-text">Mimopracovní doba. Pracovní doba od 09:00 do 17:00</h3>',
            ];
        }

        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', "$date $time");

        $endDateTime = $startDateTime->copy();

        if ($country == 3) {
            $workingDays = intdiv($duration, 420);
            $remainingMinutes = $duration % 420;
            $endDateTime = $endDateTime->addWeeks(floor($workingDays / 4))->addWeekdays($workingDays % 4);
        } else {
            $workingDays = intdiv($duration, 480);
            $remainingMinutes = $duration % 480;
            $endDateTime = $endDateTime->addWeekdays($workingDays);
        }

        $endDateTime = $endDateTime->addMinutes($remainingMinutes);

        $start = Carbon::createFromFormat('H:i:s', '09:00:00');
        $endOfWorkDayForCountry3 = Carbon::createFromFormat('H:i:s', '16:00:00');
        $endOfWorkDay = Carbon::createFromFormat('H:i:s', '17:00:00');
        $time = Carbon::createFromFormat('H:i:s', $time);


        if ($country == 3) {

            while (
                $this->isWeekend($endDateTime->format('Y-m-d'), $country) ||
                $this->isHoliday($endDateTime->format('Y-m-d'), $country) ||
                $endDateTime->format('H:i:s') < $start->format('H:i:s') ||
                $endDateTime->format('H:i:s') > $endOfWorkDayForCountry3->format('H:i:s')
            ) {

                $firstConditionExecuted = false;
                if (strtotime($time) > strtotime($endOfWorkDayForCountry3)) {
                    $endDateTime = $endDateTime->addDay()->setTime(9, 0, 0)->addMinutes($remainingMinutes);
                    $firstConditionExecuted = true;
                } elseif (strtotime($time) < strtotime($start)) {
                    $endDateTime = $endDateTime->setTime(9, 0, 0)->addMinutes($remainingMinutes);
                    $firstConditionExecuted = true;
                }

                if (!$firstConditionExecuted && $endDateTime->format('H:i:s') > $endOfWorkDayForCountry3) {
                } elseif (!$firstConditionExecuted && $endDateTime->format('H:i:s') < $endOfWorkDayForCountry3) {
                    $diff = $endOfWorkDayForCountry3->diffInMinutes($time);
                    $minutesLeftToWork = $remainingMinutes - $diff;
                    $endDateTime = $endDateTime->addDay()->setTime(9, 0, 0)->addMinutes($minutesLeftToWork);
                }
            }

        } else {
            while (
                $endDateTime->format('H:i:s') < $start->format('H:i:s') ||
                $endDateTime->format('H:i:s') > $endOfWorkDay->format('H:i:s') ||
                $this->isWeekend($endDateTime->format('Y-m-d'), $country) ||
                $this->isHoliday($endDateTime->format('Y-m-d'), $country)

            ) {
                $firstConditionExecuted = false;
                if (strtotime($time) > strtotime($endOfWorkDay)) {
                    $endDateTime = $endDateTime->addDay()->setTime(9, 0, 0)->addMinutes($remainingMinutes);
                    $firstConditionExecuted = true;
                } elseif (strtotime($time) < strtotime($start)) {
                    $endDateTime = $endDateTime->setTime(9, 0, 0)->addMinutes($remainingMinutes);
                    $firstConditionExecuted = true;
                }

                if (!$firstConditionExecuted && $endDateTime->format('H:i:s') > $endOfWorkDay) {
                } elseif (!$firstConditionExecuted && $endDateTime->format('H:i:s') < $endOfWorkDay) {
                    $diff = $endOfWorkDay->diffInMinutes($time);
                    $minutesLeftToWork = $remainingMinutes - $diff;
                    $endDateTime = $endDateTime->addDay()->setTime(9, 0, 0)->addMinutes($minutesLeftToWork);
                }
            }
        }

        $estimatedCompletionDateTime = $endDateTime->format('d-m-Y H:i:s');

        if ($date != ($this->isHoliday($date, $country) || $this->isWeekend($date, $country))) {
            if ($country == 1) {
                $dayName = Carbon::parse($date)->locale('cs')->dayName;
            }elseif ($country == 2) {
                $dayName = Carbon::parse($date)->locale('de')->dayName;
            }else{
                $dayName = Carbon::parse($date)->locale('nl')->dayName;
            }
            $result = [
                'date' => Carbon::parse($date)->format('d-m-Y'),
                'message' =>  "Work day! "." $dayName",
                'date_end' => $estimatedCompletionDateTime,
                'time' => '',
            ];
        }elseif ($date == $this->isHoliday($date, $country)) {
            $date = Carbon::parse($date)->format('Y-m-d');
            $holiday_res = Holiday::where('date', $date)->where('country_id', $country)->first();
            if ($country == 1) {
                $dayName = Carbon::parse($date)->locale('cs')->dayName;
            }elseif ($country == 2) {
                $dayName = Carbon::parse($date)->locale('de')->dayName;
            }else{
                $dayName = Carbon::parse($date)->locale('nl')->dayName;
            }
            $result = [
                'date' => Carbon::parse($holiday_res->date)->format('d-m-Y'),
                'message' => "$dayName, "." $holiday_res->name",
                'date_end' => '',
                'time' => '',
            ];
        }elseif ($date == $this->isWeekend($date, $country)) {
            if ($country == 1) {
                $dayName = Carbon::parse($date)->locale('cs')->dayName;
            }elseif ($country == 2) {
                $dayName = Carbon::parse($date)->locale('de')->dayName;
            }else{
                $dayName = Carbon::parse($date)->locale('nl')->dayName;
            }
            $result = [
                'date' => Carbon::parse($date)->format('d-m-Y'),
                'message' => "It is weekend!" . "$dayName",
                'date_end' => '',
                'time' => '',
            ];
        }

        return [
            'status' => 'ok',
            'date_view' => view('blocks.dateResult', $result)->render(),
        ];
    }

    private function isWeekend($date, $country) {
        if ($country == 3) {
            return (date('N', strtotime($date)) >= 5);
        }else{
            return (date('N', strtotime($date)) >= 6);
        }
    }


    private function isHoliday($date, $country)
    {
        $date = Carbon::parse($date)->format('Y-m-d');
        $holidays = Holiday::where('country_id', $country)->get();

        $holidays_arr = [];
        foreach ($holidays as $key => $holiday) {
            $holidays_arr[] = $holiday['date'];
        }

        return in_array($date, $holidays_arr);
    }

    public function checkApi(Request $request){

        $date = $request->date;
        $time = $request->time;
        $duration = $request->duration;
        $country = $request->country;

        $date = Carbon::parse($date)->format('Y-m-d');
        $time = Carbon::parse($time)->format('H:i:s');

        if ($date === null) {
            return response([
                'message' => 'Prosím vyberte datum!',
            ], 404);
        }

        if ($time === null) {
            return response([
                'message' => 'Prosím vyberte čas!',
            ], 404);
        }

        if ($duration === null) {
            return response([
                'message' => 'Prosím zadejte delku v minutech!',
            ], 404);
        }

        if ($country == 3 && ($time < '09:00:00' || $time > '16:00:00')) {
            return response([
                'message' => 'Mimopracovní doba. Pracovní doba od 09:00 do 16:00',
            ], 404);
        }elseif ($time < '09:00:00' || $time > '17:00:00') {
            return response([
                'message' => 'Mimopracovní doba. Pracovní doba od 09:00 do 17:00',
            ], 404);

        }


        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', "$date $time");

        $endDateTime = $startDateTime->copy();

        if ($country == 3) {
            $workingDays = intdiv($duration, 420);
            $remainingMinutes = $duration % 420;
            $endDateTime = $endDateTime->addWeeks(floor($workingDays / 4))->addWeekdays($workingDays % 4);
        } else {
            $workingDays = intdiv($duration, 480);
            $remainingMinutes = $duration % 480;
            $endDateTime = $endDateTime->addWeekdays($workingDays);
        }

        $endDateTime = $endDateTime->addMinutes($remainingMinutes);

        $start = Carbon::createFromFormat('H:i:s', '09:00:00');
        $endOfWorkDayForCountry3 = Carbon::createFromFormat('H:i:s', '16:00:00');
        $endOfWorkDay = Carbon::createFromFormat('H:i:s', '17:00:00');
        $time = Carbon::createFromFormat('H:i:s', $time);

        if ($country == 3) {

            while (
                $this->isWeekend($endDateTime->format('Y-m-d'), $country) ||
                $this->isHoliday($endDateTime->format('Y-m-d'), $country) ||
                $endDateTime->format('H:i:s') < $start->format('H:i:s') ||
                $endDateTime->format('H:i:s') > $endOfWorkDayForCountry3->format('H:i:s')
            ) {

                $firstConditionExecuted = false;
                if (strtotime($time) > strtotime($endOfWorkDayForCountry3)) {
                    $endDateTime = $endDateTime->addDay()->setTime(9, 0, 0)->addMinutes($remainingMinutes);
                    $firstConditionExecuted = true;
                } elseif (strtotime($time) < strtotime($start)) {
                    $endDateTime = $endDateTime->setTime(9, 0, 0)->addMinutes($remainingMinutes);
                    $firstConditionExecuted = true;
                }

                if (!$firstConditionExecuted && $endDateTime->format('H:i:s') > $endOfWorkDayForCountry3) {
                } elseif (!$firstConditionExecuted && $endDateTime->format('H:i:s') < $endOfWorkDayForCountry3) {
                    $diff = $endOfWorkDayForCountry3->diffInMinutes($time);
                    $minutesLeftToWork = $remainingMinutes - $diff;
                    $endDateTime = $endDateTime->addDay()->setTime(9, 0, 0)->addMinutes($minutesLeftToWork);
                }
            }

        } else {
            while (
                $endDateTime->format('H:i:s') < $start->format('H:i:s') ||
                $endDateTime->format('H:i:s') > $endOfWorkDay->format('H:i:s') ||
                $this->isWeekend($endDateTime->format('Y-m-d'), $country) ||
                $this->isHoliday($endDateTime->format('Y-m-d'), $country)

            ) {
                $firstConditionExecuted = false;
                if (strtotime($time) > strtotime($endOfWorkDay)) {
                    $endDateTime = $endDateTime->addDay()->setTime(9, 0, 0)->addMinutes($remainingMinutes);
                    $firstConditionExecuted = true;
                } elseif (strtotime($time) < strtotime($start)) {
                    $endDateTime = $endDateTime->setTime(9, 0, 0)->addMinutes($remainingMinutes);
                    $firstConditionExecuted = true;
                }

                if (!$firstConditionExecuted && $endDateTime->format('H:i:s') > $endOfWorkDay) {
                } elseif (!$firstConditionExecuted && $endDateTime->format('H:i:s') < $endOfWorkDay) {
                    $diff = $endOfWorkDay->diffInMinutes($time);
                    $minutesLeftToWork = $remainingMinutes - $diff;
                    $endDateTime = $endDateTime->addDay()->setTime(9, 0, 0)->addMinutes($minutesLeftToWork);
                }
            }
        }

        $estimatedCompletionDateTime = $endDateTime->format('d-m-Y H:i:s');

        if ($date != ($this->isHoliday($date, $country) || $this->isWeekend($date, $country))) {
            if ($country == 1) {
                $dayName = Carbon::parse($date)->locale('cs')->dayName;
            }elseif ($country == 2) {
                $dayName = Carbon::parse($date)->locale('de')->dayName;
            }else{
                $dayName = Carbon::parse($date)->locale('nl')->dayName;
            }
            $result = [
                'date' => Carbon::parse($date)->format('d-m-Y'),
                'message' =>  "Work day! "." $dayName",
                'date_end' => $estimatedCompletionDateTime,
                'time' => '',
            ];
            $date_result = Carbon::parse($date)->format('d-m-Y');
            $message_result = "Work day! "." $dayName";
            $date_end_result = $estimatedCompletionDateTime;
            $time_result = '';

        }elseif ($date == $this->isHoliday($date, $country)) {
            $date = Carbon::parse($date)->format('Y-m-d');
            $holiday_res = Holiday::where('date', $date)->where('country_id', $country)->first();
            if ($country == 1) {
                $dayName = Carbon::parse($date)->locale('cs')->dayName;
            }elseif ($country == 2) {
                $dayName = Carbon::parse($date)->locale('de')->dayName;
            }else{
                $dayName = Carbon::parse($date)->locale('nl')->dayName;
            }
            $result = [
                'date' => Carbon::parse($holiday_res->date)->format('d-m-Y'),
                'message' => "$dayName, "." $holiday_res->name",
                'date_end' => '',
                'time' => '',
            ];
            $date_result = Carbon::parse($holiday_res->date)->format('d-m-Y');
            $message_result = "$dayName, "." $holiday_res->name";
            $date_end_result = '';
            $time_result = '';
        }elseif ($date == $this->isWeekend($date, $country)) {
            if ($country == 1) {
                $dayName = Carbon::parse($date)->locale('cs')->dayName;
            }elseif ($country == 2) {
                $dayName = Carbon::parse($date)->locale('de')->dayName;
            }else{
                $dayName = Carbon::parse($date)->locale('nl')->dayName;
            }
            $result = [
                'date' => Carbon::parse($date)->format('d-m-Y'),
                'message' => "It is weekend!" . "$dayName",
                'date_end' => '',
                'time' => '',
            ];
            $date_result = Carbon::parse($date)->format('d-m-Y');
            $message_result = "It is weekend!" . "$dayName";
            $date_end_result = '';
            $time_result = '';
        }

        return response()->json([
            'status' => 'ok',
            'date_result' => $date_result,
            'message_result' => $message_result,
            'date_end_result' => $date_end_result,
            'time_result' => $time_result,
        ], 200, [], 128);
    }
}
