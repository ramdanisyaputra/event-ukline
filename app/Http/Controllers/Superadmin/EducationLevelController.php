<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\EducationLevel;
use Illuminate\Support\Facades\Request;

class EducationLevelController extends Controller
{
    public function index(Request $request)
    {
        $educationLevel = EducationLevel::all();
        return view('/superadmin/master/education-level/index',compact('educationLevel'));
    }
    public function store(Request $request)
    {
        EducationLevel::create($request->all());
        return redirect()->back()->with('success','Tingkat pendidikan berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        EducationLevel::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Tingkat pendidikan berhasil diubah');
    }
}
