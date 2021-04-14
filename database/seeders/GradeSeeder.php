<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $romans = ["I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
        for($i = 1; $i <=9; $i++ )
        {
            Grade::create([
                'number' => $i,
                'roman' => $romans[$i-1],
                'school_year' => "2020/2021",
                'education_level_id' => ($i < 7) ? 1 : (($i < 10) ? 2 : 3),
            ]);
        }
    }
}
