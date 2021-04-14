<?php

namespace Database\Seeders;

use App\Models\EducationLevel as ModelsEducationLevel;
use Illuminate\Database\Seeder;

class EducationLevel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * 
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'=>'SD',
                'level_code'=>'001',
            ],
            [
                'name'=>'SMP',
                'level_code'=>'002',
            ],
            [
                'name'=>'SMA',
                'level_code'=>'003',
            ],
        ];

        for ($i=0; $i < count($data); $i++) { 
            ModelsEducationLevel::create($data[$i]);
        }
    }
}
