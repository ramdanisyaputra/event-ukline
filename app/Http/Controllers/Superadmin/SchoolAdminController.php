<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\SchoolAdmin;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class SchoolAdminController extends Controller
{
    public function index(Request $request)
    {
        $schoolAdmin = SchoolAdmin::all();
        return view('/superadmin/school/school-admin/index',compact('schoolAdmin'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'username'=>'required',
            'password'=>'required',
            'school_id'=>'required',
            'username'=>'unique:school_admins',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['password'] = bcrypt($request->password);
        $data['school_id'] = $request->school_id;
        SchoolAdmin::create($data);
        return redirect()->back()->with('success','Admin sekolah berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'=>'unique:school_admins,username,'. $request->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data')->withInput();
        }
        SchoolAdmin::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Admin sekolah berhasil diubah');
    }
}
