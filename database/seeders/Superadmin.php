<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class Superadmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'admin',
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('admin'),
        ]);
    }
}
