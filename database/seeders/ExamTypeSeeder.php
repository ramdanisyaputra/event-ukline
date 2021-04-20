<?php

namespace Database\Seeders;

use App\Models\ExamType;
use Illuminate\Database\Seeder;

class ExamTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'=>'Tryout'
            ],
            [
                'name'=>'PAS'
            ],
            [
                'name'=>'PTS'
            ],
        ];

        for ($i=0; $i < count($data); $i++) { 
            ExamType::create($data[$i]);
        }
    }
}
