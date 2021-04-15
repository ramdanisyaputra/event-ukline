<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function adminGuard()
    {
        $adminGuard = Auth::guard(session()->get('role'))->user();
        return $adminGuard;
    }
    public function index(Request $request)
    {
        $subjects = Subject::where('school_id', $this->adminGuard()->school_id)->get();
        return view('school_admin.subjects.index',compact('subjects'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }
        
        $subject = new Subject();
        $subject->name=$request->name;
        $subject->school_id=$this->adminGuard()->school_id;
        $subject->save();

        return redirect()->back()->with('success','Mata pelajaran berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $subject = Subject::find($request->id);
        $subject->name=$request->name;
        $subject->school_id=$this->adminGuard()->school_id;
        $subject->save();

        return redirect()->back()->with('success','Mata pelajaran berhasil diubah');
    }
}
