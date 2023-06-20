<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Holiday, Country};
use Carbon\Carbon;
use Carbon\CarbonImmutable;


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


         // Парсим начальную дату и время
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', "$date $time");

        // Устанавливаем начальное время окончания равным начальному времени
        $endDateTime = $startDateTime->copy();

        // Учитываем рабочие дни
        if ($country == 3) {
            $workingDays = intdiv($duration, 420); // 420 минут - продолжительность рабочего дня (7 часов)
            $remainingMinutes = $duration % 420;
            // Если страна имеет 4-дневную рабочую неделю (Пн-Чт)
            $endDateTime = $endDateTime->addWeeks(floor($workingDays / 4))->addWeekdays($workingDays % 4);
        } else {
            $workingDays = intdiv($duration, 480); // 480 минут - продолжительность рабочего дня (8 часов)
            $remainingMinutes = $duration % 480;
            // Если страна имеет 5-дневную рабочую неделю (Пн-Пт)
            $endDateTime = $endDateTime->addWeekdays($workingDays);
        }

        // Добавляем оставшееся время (в минутах) к времени окончания
        $endDateTime = $endDateTime->addMinutes($remainingMinutes);

        // Проверяем, попадает ли время окончания внутрь рабочего дня, выходной день или праздничный день
        while (
            $endDateTime->format('H:i:s') > '17:00:00' ||
            $endDateTime->isWeekend() ||
            $this->isHoliday($endDateTime->format('Y-m-d'), $country)
        ) {
            // Если время окончания попадает на выходной день, после 17:00 или праздничный день, добавляем еще один день
            $endDateTime = $endDateTime->addDay()->setTime(9, 0, 0);
        }


        if ($country == 3) {
            // Проверяем, попадает ли время окончания внутрь рабочего дня, выходной день или праздничный день
            while (
                $endDateTime->format('H:i:s') > '16:00:00' ||
                $endDateTime->isWeekend() ||
                $this->isHoliday($endDateTime->format('Y-m-d'), $country)
            ) {
                // Если время окончания попадает на выходной день, после 16:00 или праздничный день, добавляем еще один день
                $endDateTime = $endDateTime->addDay()->setTime(9, 0, 0);
            }
        } else {
            // Проверяем, попадает ли время окончания внутрь рабочего дня, выходной день или праздничный день
            while (
                $endDateTime->format('H:i:s') > '17:00:00' ||
                $endDateTime->isWeekend() ||
                $this->isHoliday($endDateTime->format('Y-m-d'), $country)
            ) {
                // Если время окончания попадает на выходной день, после 17:00 или праздничный день, добавляем еще один день
                $endDateTime = $endDateTime->addDay()->setTime(9, 0, 0);
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
                'date_end' => $endDateTime->format('d-m-Y'),
                'time' => $endDateTime->format('H:i:s'),
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

    // private function isWeekend($date, $country) {
    //     if ($country == 3) {
    //         return (date('N', strtotime($date)) >= 5);
    //     }else{
    //         return (date('N', strtotime($date)) >= 6);
    //     }
    // }

    private function isWeekend($date, $country)
    {
        if ($country == 3) {
            return (Carbon::parse($date)->dayOfWeek >= Carbon::SATURDAY);
        } else {
            return (Carbon::parse($date)->dayOfWeek >= Carbon::SUNDAY);
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

    private function calculateCompletionDate($startDateTime, $duration, $country)
    {
        // Инициализация переменных
        if ($country == 3) {
            $workingHoursPerDay = 7;
            $workingDays = 0;
        }else{
            $workingHoursPerDay = 8;
            $workingDays = 0;
        }

            // Инициализация переменных
            $workingHoursPerDay = 8;
            $workingDays = 0;

            // Учет только рабочих дней
            while ($duration > 0) {
                // Проверка, является ли текущий день рабочим
                if (!$this->isWeekend($startDateTime, $country) && !$this->isHoliday($startDateTime, $country)) {
                    $workingDays++;
                }

                // Переход к следующему дню
                $startDateTime->addDay();
                $duration -= $workingHoursPerDay * 60; // Конвертирование часов в минуты
            }

            // Установка времени окончания в конце рабочего дня
            $endDateTime = $startDateTime->setTime(17, 0, 0); // Предполагаемое время окончания в 17:00

            // Проверка, является ли предполагаемое время окончания выходным днем или праздником
            while ($this->isWeekend($endDateTime, $country) || $this->isHoliday($endDateTime, $country)) {
                $endDateTime->addDay();
            }

            return $endDateTime;
    }

}

//  Task 2  1.input date time 2.duration time  output : date and time end
