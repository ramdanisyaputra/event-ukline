<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'nisn' => '120345',
            'nis' => '120345',
            'name' => 'Muhamad Maulana Lukma Sukma Eka Dharma Bhakti Chandra Restori Ilm Wiguna Satya',
            'dob' => 'Jakarta, 14 Juli 2006',
            'gender' => 'Laki-Laki',
            'class_id' => 1,
        ]);
    }
}
