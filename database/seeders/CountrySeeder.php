<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
               'en_country'=>'Torky',
               'ar_country'=>'تركيا',

            ]

        ];

        foreach ($countries as $key => $country) {
            Country::create($country);
        }
    }
}
