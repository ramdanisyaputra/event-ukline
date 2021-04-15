<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classes::create([
            'name' => 'Kelas 7 A',
            'school_id' => 1,
            'grade_id' => 7,
        ]);
    }
}
