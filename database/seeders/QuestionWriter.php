<?php

namespace Database\Seeders;

use App\Models\QuestionWriter as ModelsQuestionWriter;
use Illuminate\Database\Seeder;

class QuestionWriter extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsQuestionWriter::create([
            'name'=>'writer',
            'username'=>'writer',
            'password'=>bcrypt('writer'),
            'regency_id'=>'1',
        ]);
    }
}
