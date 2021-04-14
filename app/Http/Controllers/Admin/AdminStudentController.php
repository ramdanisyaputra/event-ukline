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
        return view('school_admin.students.index',compact('grades'));
    }
    public function indexStudent($classId)
    {
        $students = Student::where('class_id', $classId)->get();
        $class = Classes::find($classId);
        return view('school_admin.students.index-student',compact('students','class'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'grade_id'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }

        $classes = new Classes();
        $classes->name = $request->name;
        $classes->school_id = $this->authUser()->school_id;
        $classes->grade_id = $request->grade_id;
        $classes->save();
        
        return redirect()->back()->with('success','Kelas berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        Classes::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Kelas berhasil diubah');
    }
}
