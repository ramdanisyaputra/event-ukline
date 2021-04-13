<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\EducationLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EducationLevelController extends Controller
{
    public function index(Request $request)
    {
        $educationLevels = EducationLevel::all();
        return view('superadmin.education-levels.index',compact('educationLevels'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'level_code'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }
        EducationLevel::create($request->all());
        return redirect()->back()->with('success','Tingkat pendidikan berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        EducationLevel::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Tingkat pendidikan berhasil diubah');
    }
}
