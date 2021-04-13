<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::create([
            'name' => 'SMA Negeri 10 Sulukama',
            'address' => 'Kota Bogor',
            'headmaster_name' => 'Rudi Sulaiman Winarto, M,Pd.',
            'active_status' => true,
            'status' => 'resmi',
            'education_level_id' => 1,
            'regency_id' => 1,
        ]);
    }
}
