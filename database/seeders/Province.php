<?php

namespace Database\Seeders;

use App\Models\Province as ModelsProvince;
use Illuminate\Database\Seeder;

class Province extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsProvince::create([
            'name'=>'Jawa Barat',
            'province_code'=>'001'
        ]);
    }
}
