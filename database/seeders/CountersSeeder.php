<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('counters')->insert([[
            'image' => "plane.webp",
            'title_en' => "Travel packages",
            'title_ar' => "شحنات التوصيل",
            'vlaue' => 9000,
            'order' => 0,
        ],[
            'image' => "global.webp",
            'title_en' => "branches all over",
            'title_ar' => "فروعنا حول العالم",
            'vlaue' => 9000,
            'order' => 1,
        ],[
            'image' => "man.webp",
            'title_en' => "expert agents",
            'title_ar' => "متخصصين",
            'vlaue' => 9000,
            'order' => 2,
        ],[
            'image' => "ballon.webp",
            'title_en' => "acitivties listed",
            'title_ar' => "الانشطة المتاحة",
            'vlaue' => 9000,
            'order' => 3,
        ]]);
    }
}
