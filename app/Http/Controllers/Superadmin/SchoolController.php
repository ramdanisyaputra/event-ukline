<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        $school = School::all();
        return view('/superadmin/school/index',compact('school'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'status'=>'required',
            'headmaster_name'=>'required',
            'address'=>'required',
            'active_status'=>'required',
            'regency_id'=>'required',
            'education_level_id'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }

        School::create($request->all());
        return redirect()->back()->with('success','Kelas berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        School::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Kelas berhasil diubah');
    }
}
