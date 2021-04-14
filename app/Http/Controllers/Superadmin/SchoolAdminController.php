<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SchoolAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolAdminController extends Controller
{
    public function index(Request $request)
    {
        $schoolAdmins = SchoolAdmin::all();
        $schoolId = [];
        foreach($schoolAdmins as $admin){
            $schoolId[] = $admin->school_id;
        }
        $schools = School::whereNotIn('id',$schoolId)->get();
        return view('superadmin.school_admins.index',compact('schoolAdmins','schools'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'username'=>'unique:school_admins',
            'school_id'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['password'] = bcrypt($request->username);
        $data['school_id'] = $request->school_id;
        SchoolAdmin::create($data);
        return redirect()->back()->with('success','Admin sekolah berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'=>'unique:school_admins,username,'. $request->id,
            'name'=>'required',
            'school_id'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data')->withInput();
        }
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['school_id'] = $request->school_id;
        SchoolAdmin::find($request->id)->update($data);
        return redirect()->back()->with('success','Admin sekolah berhasil diubah');
    }
    public function resetPassword(Request $request)
    {
        $schoolAdmin = SchoolAdmin::find($request->id);
        $schoolAdmin->update([
            'password'=>bcrypt($schoolAdmin->username)
        ]);
        $message = 'Password '. $schoolAdmin->username. ' berhasil di reset';
        return redirect()->back()->with('success',$message);
    }
}
