<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'overview_entitle'=>' ',
            'overview_artitle'=>' ',
            'overview_ensubtitle'=>' ',
            'overview_arsubtitle'=>' ',
            'overview_en'=>' ',
            'overview_ar'=>' ',
            'image'=>' ',
            'mission_en'=>' ',
            'mission_ar'=>' ',
            'vision_en'=>' ',
            'vision_ar'=>' ',
            'facebook'=>' ',
            'youtube'=>' ',
            'instagram'=>' ',
            'best_hotels_en_desc'=>' ',
            'best_hotels_ar_desc'=>' ',
            'book_tour_en_desc'=>' ',
            'book_tour_ar_desc'=>' ',
            'book_tour_vedio'=>' ',
            'book_tour_en_title'=>' ',
            'book_tour_ar_title'=>' ',
            'book_transport_en_desc'=>' ',
            'book_transport_ar_desc'=>' ',
            'book_transport_vedio'=>' ',
            'book_transport_en_title'=>' ',
            'book_transport_ar_title'=>' ',
        ]);
    }
}
