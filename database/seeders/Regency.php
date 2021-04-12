<?php

namespace Database\Seeders;

use App\Models\Regency as ModelsRegency;
use Illuminate\Database\Seeder;

class Regency extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsRegency::create([
            'name'=>'Bogor',
            'province_id'=>'1',
            'regency_code'=>'011'
        ]);
    }
}
