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
        $educationLevels = EducationLevel::orderBy('name','ASC')->get();
        return view('superadmin.education-levels.index',compact('educationLevels'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|unique:education_levels',
            'level_code'=>'required|unique:education_levels',
        ], [
            'name.required' => 'Tingkat pendidikan wajib diisi',
            'name.unique' => 'Tingkat pendidikan telah digunakan',
            'level_code.required' => 'Kode tingkat pendidikan wajib diisi',
            'level_code.unique' => 'Kode tingkat pendidikan telah digunakan',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput()->withErrors($validator);
        }
        EducationLevel::create($request->all());
        return redirect()->back()->with('success','Tingkat pendidikan berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|unique:education_levels,name,'.$request->id,
            'level_code'=>'required|unique:education_levels,level_code,'.$request->id
        ], [
            'name.required' => 'Tingkat pendidikan wajib diisi',
            'name.unique' => 'Tingkat pendidikan telah digunakan',
            'level_code.required' => 'Kode tingkat pendidikan wajib diisi',
            'level_code.unique' => 'Kode tingkat pendidikan telah digunakan',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput()->withErrors($validator);
        }
        EducationLevel::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Tingkat pendidikan berhasil diubah');
    }
}
