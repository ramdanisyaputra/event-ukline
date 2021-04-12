<?php

namespace Database\Seeders;

use App\Models\School as ModelsSchool;
use Illuminate\Database\Seeder;

class School extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsSchool::create([
            'name'=>'SMK 1',
            'status'=>'resmi',
            'headmaster_name'=>'Jajat',
            'address'=>'Cisarua',
            'active_status'=>'1',
            'regency_id'=>'1',
            'education_level_id'=>'1',
        ]);
    }
}
