<?php

namespace App\Imports;

use App\Models\Student;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImport implements ToCollection
{
    protected $classId;
    protected $schoolId;
    function __construct($classId,$schoolId)
    {
        $this->classId = $classId;
        $this->schoolId = $schoolId;
    }

    public function collection(Collection $rows)
    {
        $classId = $this->classId;
        $schoolId = $this->schoolId;

        
        $student=[];

        foreach($rows as $key => $row)
        {
            if ($key != 0) {
                $nisn = $row[0];
                $nis = $row[1];
                $name = $row[2];
                $pob = $row[3];
                $dob = $row[4];
                $student_number = $row[5];
                $gender = $row[6];
                $username = $row[0];
                $password = $row[7];
                $class_id = $classId;
                $school_id = $schoolId;
    
                $validator = Validator::make(compact('nisn', 'nis', 'name', 'pob', 'dob', 'student_number', 'gender', 'password'), [
                    'nisn' => 'required|unique:students,nisn',
                    'nis' => 'required',
                    'name' => 'required',
                    'pob' => 'required',
                    'dob' => 'required',
                    'student_number' => 'required',
                    'gender' => 'required',
                    'password' => 'required',
                ]);
    
                if ($validator->fails()) {
                    throw new Exception($validator->getMessageBag(), 1);
                }

                $student[] = [
                    'nisn' => $nisn,
                    'nis' => $nis,
                    'name' => $name,
                    'pob' => $pob,
                    'dob' => $dob,
                    'student_number' => $student_number,
                    'gender' => $gender,
                    'username' => $username,
                    'password' => bcrypt($password),
                    'class_id' => $class_id,
                    'school_id' => $school_id,
                ];
            }
        }

        return DB::table('students')->insert($student);

    }
}
