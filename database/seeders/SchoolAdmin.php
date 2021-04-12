<?php

namespace Database\Seeders;

use App\Models\SchoolAdmin as ModelsSchoolAdmin;
use Illuminate\Database\Seeder;

class SchoolAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsSchoolAdmin::create([
            'name'=>'admin',
            'username'=>'admin',
            'password'=>bcrypt('admin'),
            'school_id'=>'1',
        ]);
    }
}
