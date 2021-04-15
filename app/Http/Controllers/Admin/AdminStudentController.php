<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StudentExport;
use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Excel;


class AdminStudentController extends Controller
{
    
    public function index(Request $request)
    {
        $classes = Classes::where('school_id', $this->authUser()->school_id)->get();
        return view('school_admin.students.index',compact('classes'));
    }
    public function indexStudent($classId)
    {
        $students = Student::where('class_id', $classId)->get();
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
            'password'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }

        $student = new Student();
        $student->nisn = $request->nisn;
        $student->nis = $request->nis;
        $student->name = $request->name;
        $student->pob = $request->pob;
        $student->dob = $request->dob;
        $student->student_number = $request->student_number;
        $student->gender = $request->gender;
        $student->username = $request->nisn; //username itu nisn
        $student->password = $request->password;
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
        $student = Student::find($request->id);
        $student->nisn = $request->nisn;
        $student->nis = $request->nis;
        $student->name = $request->name;
        $student->pob = $request->pob;
        $student->dob = $request->dob;
        $student->student_number = $request->student_number;
        $student->gender = $request->gender;
        $student->username = $request->nisn; //username itu nisn
        $student->class_id = $classId;
        $student->school_id = $this->authUser()->school_id;
        $student->save();

        return redirect()->back()->with('success','Siswa berhasil diubah');
    }
    
    public function resetPasswordStudent($classId,$studentId)
    {
        $student = Student::find($studentId);
        $student->password = bcrypt($student->username);
        $student->save();

        return redirect()->back()->with('success','Berhasil Reset Password Penulis Soal');
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
}
