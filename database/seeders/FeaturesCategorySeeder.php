<?php

namespace Database\Seeders;

use App\Models\Features_category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeaturesCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            [
               'en_category'=>'Admin User',
               'ar_category'=>'admin@system.com',

            ],
            [
               'en_category'=>'Manager User',
               'ar_category'=>'manager@system.com',

            ],
            [
               'en_category'=>'User',
               'ar_category'=>'user@system.com',

            ],

            [
                'en_category'=>'Admin User',
                'ar_category'=>'admin@system.com',

             ],
             [
                'en_category'=>'Manager User',
                'ar_category'=>'manager@system.com',

             ],
             [
                'en_category'=>'User',
                'ar_category'=>'user@system.com',

             ],
        ];

        foreach ($rows as $key => $row) {
            Features_category::create($row);
        }
    }
}
