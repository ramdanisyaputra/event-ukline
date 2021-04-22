<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StudentExport;
use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Models\Classes;
use App\Models\ExamScore;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AdminStudentController extends Controller
{
    
    public function index(Request $request)
    {
        $classes = Classes::where('school_id', $this->authUser()->school_id)->get();
        return view('school_admin.students.index',compact('classes'));
    }
    public function indexStudent($classId)
    {
        $students = Student::where('class_id', $classId)->orderBy('name','ASC')->get();
        $class = Classes::find($classId);
        return view('school_admin.students.index-student',compact('students','class'));
    }

    public function store(Request $request ,$classId)
    {
        $validator = Validator::make($request->all(), [
            'nisn'=>'required|unique:students',
            'nis'=>'required',
            'name'=>'required',
            'pob'=>'required',
            'dob'=>'required',
            'student_number'=>'required',
            'gender'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }
        
        $date = date("d",strtotime($request->dob));

        $student = new Student();
        $student->nisn = $request->nisn;
        $student->nis = $request->nis;
        $student->name = $request->name;
        $student->pob = $request->pob;
        $student->dob = $request->dob;
        $student->student_number = $request->student_number;
        $student->gender = $request->gender;
        $student->username = $request->nisn; //username itu nisn
        $student->password = bcrypt($request->nisn.'-'.$date);
        $student->class_id = $classId;
        $student->school_id = $this->authUser()->school_id;
        $student->save();
        
        return redirect()->back()->with('success','Siswa berhasil ditambahkan');
    }
    public function update(Request $request, $classId)
    {
        $validator = Validator::make($request->all(), [
            'nisn'=>'unique:students,nisn,'. $request->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data')->withInput();
        }
        $date = date("d",strtotime($request->dob));


        $student = Student::find($request->id);
        $student->nisn = $request->nisn;
        $student->nis = $request->nis;
        $student->name = $request->name;
        $student->pob = $request->pob;
        $student->dob = $request->dob;
        $student->student_number = $request->student_number;
        $student->gender = $request->gender;
        $student->username = $request->nisn; //username itu nisn
        $student->password = bcrypt($request->nisn.'-'.$date);
        $student->class_id = $classId;
        $student->school_id = $this->authUser()->school_id;
        $student->save();

        return redirect()->back()->with('success','Siswa berhasil diubah');
    }
    
    public function resetPasswordStudent($studentId)
    {
        $student = Student::find($studentId);
        $date = date("d",strtotime($student->dob));
        $student->password = bcrypt($student->username.'-'.$date);
        $student->save();

        return redirect()->back()->with('success','Berhasil Reset Password Siswa Sesuai NISN');
    }

    public function import(Request $request , $classId)
    {
		try {
            Excel::import(new StudentImport($classId,$this->authUser()->school_id),$request->file('file'));
		} catch (\Exception $ex) {
            $errorMsg = json_decode($ex->getMessage());
            $msg = 'Kolom ';
            foreach ($errorMsg as $key => $value) {
                $msg .= "$key, ";
            }
            $msg = rtrim($msg, ", ");
            $msg .= ' tidak sesuai!';

            return back()->with('alert',$msg);
		}
        return back()->with('success','Berhasil Import Data Siswa');
    }
    public function export(Request $request)
    {
		try {
            return Excel::download(new StudentExport($request->id), 'Data Siswa.xlsx');
		} catch (\Exception $ex) {
            $errorMsg = json_decode($ex->getMessage());
            return back()->with('alert','Gagal export data');
		}
    }
    public function delete($studentId)
    {
        Student::find($studentId)->delete();
        return back()->with('success','Berhasil Hapus Data Siswa');
    }
    public function deleteAll($classId)
    {
        $students = Student::where('class_id', $classId);
        $studentId = [];
        foreach($students->get() as $student)
        {
            $studentId [] =  $student->id;
        }
        ExamScore::whereIn('student_id', $studentId)->delete();
        $students->delete();
        return back()->with('success','Berhasil Hapus Semua Data Siswa');
    }
}
