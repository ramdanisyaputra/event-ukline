<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $classId;
    function __construct($classId)
    {
        $this->classId = $classId;
    }
    public function collection()
    {
        $models = Student::where('class_id',$this->classId)
        ->select('nisn','nis','name','pob','dob','student_number','gender','nisn')->get();
        
        foreach ($models as $key => $student) {
            $result['items'][$key]['nisn'] = $student->nisn;
            $result['items'][$key]['nis'] = $student->nis;
            $result['items'][$key]['name'] = $student->name;
            $result['items'][$key]['pob'] = $student->pob;
            $result['items'][$key]['dob'] = $student->dob;
            $result['items'][$key]['student_number'] = $student->student_number;
            $result['items'][$key]['gender'] = $student->gender;
            $result['items'][$key]['password'] = $student->nisn;
        }

        return collect($result);
    }

    public function headings(): array
    {
    	return [
            'NISN',
    		'NIS',
    		'Nama',
    		'Tempat Lahir',
    		'Tanggal Lahir',
    		'Nomor Peserta',
    		'Jenis Kelamin',
    		'Password',
    	];
    }
}
