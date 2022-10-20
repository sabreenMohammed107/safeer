<?php

namespace Database\Seeders;

use App\Models\Company_branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company_branch::create([
            'branch_enname'=>' ',
            'branch_arname'=>' ',
            'detailed_address_en'=>' ',
            'detailed_address_ar'=>' ',
            'phone'=>' ',
            'fax'=>' ',
            'email'=>' ',
            'google_map'=>' ',
            'master_flag'=>1,
        ]);
    }
}
