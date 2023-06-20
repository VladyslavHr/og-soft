<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;


class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = Country::create([
            'name' => 'Česko',
        ]);

        $country = Country::create([
            'name' => 'Německo',
        ]);

        $country = Country::create([
            'name' => 'Nizozemsko',
        ]);

    }
}
