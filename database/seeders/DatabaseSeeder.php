<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Province::class,
            Superadmin::class,
            Regency::class,
            EducationLevel::class,
            School::class,
            QuestionWriter::class,
            SchoolAdmin::class,
        ]);
    }
}
