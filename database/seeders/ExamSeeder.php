<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exam::create([
            'name' => 'Ilmu Pengetahuan Sosial',
            'exam_type_id' => 1,
            'started_at' => '2021-04-13 14:00:00',
            'expired_at' => '2021-04-13 23:00:00',
            'duration' => 60,
            'regency_id' => 1,
            'school_id' => 1,
            'status' => 'published',
        ]);
    }
}
