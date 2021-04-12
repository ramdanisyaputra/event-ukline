<?php

namespace Database\Seeders;

use App\Models\EducationLevel as ModelsEducationLevel;
use Illuminate\Database\Seeder;

class EducationLevel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsEducationLevel::create([
            'name'=>'1',
            'level_code'=>'001',
        ]);
    }
}
