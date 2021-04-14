<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'student_number'=>'required|unique:students',
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
            'student_number'=>'unique:students,student_number,'. $request->id,
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
}
