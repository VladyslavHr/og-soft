<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Holiday;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $holidays = [
            '2023-01-01',
            '2023-04-07',
            '2023-04-10',
            '2023-05-01',
            '2023-05-08',
            '2023-07-05',
            '2023-07-06',
            '2023-09-28',
            '2023-10-28',
            '2023-11-17',
            '2023-12-24',
            '2023-12-25',
            '2023-12-26',
        ];

        $names = [
            "Nový rok",
            "Velký pátek",
            "Velikonoční pondělí",
            "Svátek práce",
            "Den vítězství",
            "Den věrozvěstů Cyrila a Metoděje",
            "Den upálení mistra Jana Husa",
            "Den české státnosti",
            "Den vzniku Československa",
            "Den boje za svobodu a demokracii",
            "Štědrý den",
            "1.svátek vánoční",
            "2.svátek vánoční",
        ];

        // foreach ( $array1 as $idx => $val ) {
        //     $all_array[] = [ $val, $array2[$idx], $array3[$idx] ];
        // }


        // $results = array_combine($names, $holidays);


        // foreach ($results as $key => $result) {
        //     CzHoliday::create([
        //         'name' => $key,
        //         'date' => $result,
        //     ]);
        // }


        $holiday = Holiday::create([
            'country_id' => 1,
            'name' => 'Nový rok',
            'date' => '2023-01-01',
        ]);

        $holiday = Holiday::create([
            'country_id' => 1,
            'name' => 'Velký pátek',
            'date' => '2023-04-07',
        ]);

        $holiday = Holiday::create([
            'country_id' => 1,
            'name' => 'Velikonoční pondělí',
            'date' => '2023-04-10',
        ]);

        $holiday = Holiday::create([
            'country_id' => 1,
            'name' => 'Svátek práce',
            'date' => '2023-05-01',
        ]);

        $holiday = Holiday::create([
            'country_id' => 1,
            'name' => 'Den vítězství',
            'date' => '2023-05-08',
        ]);

        $holiday = Holiday::create([
            'country_id' => 1,
            'name' => 'Den věrozvěstů Cyrila a Metoděje',
            'date' => '2023-07-05',
        ]);

        $holiday = Holiday::create([
            'country_id' => 1,
            'name' => 'Den upálení mistra Jana Husa',
            'date' => '2023-07-06',
        ]);

        $holiday = Holiday::create([
            'country_id' => 1,
            'name' => 'Den české státnosti',
            'date' =>  '2023-09-28',
        ]);

        $holiday = Holiday::create([
            'country_id' => 1,
            'name' => 'Den vzniku Československa',
            'date' => '2023-10-28',
        ]);

        $holiday = Holiday::create([
            'country_id' => 1,
            'name' => 'Den boje za svobodu a demokracii',
            'date' => '2023-11-17',
        ]);

        $holiday = Holiday::create([
            'country_id' => 1,
            'name' => 'Štědrý den',
            'date' => '2023-12-24',
        ]);

        $holiday = Holiday::create([
            'country_id' => 1,
            'name' => '1.svátek vánoční',
            'date' => '2023-12-25',
        ]);

        $holiday = Holiday::create([
            'country_id' => 1,
            'name' => '2.svátek vánoční',
            'date' => '2023-12-26',
        ]);


        $holiday = Holiday::create([
            'country_id' => 2,
            'name' => 'Sonntag Neujahrstag',
            'date' => '2023-01-01',
        ]);

        $holiday = Holiday::create([
            'country_id' => 2,
            'name' => 'Freitag Karfreitag',
            'date' => '2023-04-07',
        ]);

        $holiday = Holiday::create([
            'country_id' => 2,
            'name' => 'Montag Ostermontag',
            'date' => '2023-04-10',
        ]);

        $holiday = Holiday::create([
            'country_id' => 2,
            'name' => 'Montag Tag der Arbeit',
            'date' => '2023-05-01',
        ]);

        $holiday = Holiday::create([
            'country_id' => 2,
            'name' => 'Donnerstag Christi Himmelfahrt',
            'date' => '2023-05-18',
        ]);

        $holiday = Holiday::create([
            'country_id' => 2,
            'name' => 'Montag Pfingstmontag',
            'date' => '2023-05-29',
        ]);

        $holiday = Holiday::create([
            'country_id' => 2,
            'name' => 'Dienstag	Tag der Deutschen Einheit',
            'date' =>  '2023-10-03',
        ]);

        $holiday = Holiday::create([
            'country_id' => 2,
            'name' => 'Montag 1. Weihnachtsfeiertag',
            'date' => '2023-12-25',
        ]);

        $holiday = Holiday::create([
            'country_id' => 2,
            'name' => 'Dienstag	2. Weihnachtsfeiertag',
            'date' => '2023-12-26',
        ]);

        $holiday = Holiday::create([
            'country_id' => 3,
            'name' => 'Nieuwjaarsdag',
            'date' => '2023-01-01',
        ]);

        $holiday = Holiday::create([
            'country_id' => 3,
            'name' => 'Goede vrijdag',
            'date' => '2023-04-07',
        ]);

        $holiday = Holiday::create([
            'country_id' => 3,
            'name' => 'Eerste en tweede paasdag',
            'date' => '2023-04-09',
        ]);

        $holiday = Holiday::create([
            'country_id' => 3,
            'name' => 'Eerste en tweede paasdag',
            'date' => '2023-04-10',
        ]);

        $holiday = Holiday::create([
            'country_id' => 3,
            'name' => 'Koningsdag',
            'date' => '2023-04-27',
        ]);

        $holiday = Holiday::create([
            'country_id' => 3,
            'name' => 'Bevrijdingsdag',
            'date' => '2023-05-05',
        ]);

        $holiday = Holiday::create([
            'country_id' => 3,
            'name' => 'Hemelvaartsdag',
            'date' => '2023-05-18',
        ]);

        $holiday = Holiday::create([
            'country_id' => 3,
            'name' => 'Eerste en tweede pinksterdag',
            'date' => '2023-05-28',
        ]);
        $holiday = Holiday::create([
            'country_id' => 3,
            'name' => 'Eerste en tweede pinksterdag',
            'date' => '2023-05-29',
        ]);
        $holiday = Holiday::create([
            'country_id' => 3,
            'name' => 'Eerste en tweede kerstdag',
            'date' => '2023-12-25',
        ]);

        $holiday = Holiday::create([
            'country_id' => 3,
            'name' => 'Eerste en tweede kerstdag',
            'date' => '2023-12-26',
        ]);

    }
}
