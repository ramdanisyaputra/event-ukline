<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\EducationLevel;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $grades = Grade::all();
        $educationLevels = EducationLevel::all();
        return view('superadmin.grades.index',compact('grades','educationLevels'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number'=>'required',
            'roman'=>'required',
            'education_level_id'=>'required',
            'school_year'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }
        Grade::create($request->all());
        return redirect()->back()->with('success','Kelas berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        Grade::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Kelas berhasil diubah');
    }
}
