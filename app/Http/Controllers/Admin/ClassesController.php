<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
class ClassesController extends Controller
{
    public function adminGuard()
    {
        $adminGuard = Auth::guard(session()->get('role'))->user();
        return $adminGuard;
    }
    public function index(Request $request)
    {
        $classes = Classes::where('school_id', $this->adminGuard()->school_id)->get();
        $grade = Grade::all();
        return view('/superadmin/classes/index',compact('classes','grade'));
    }
    public function store(Request $request)
    {
        Classes::create($request->all());
        return redirect()->back()->with('success','Kelas berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        Classes::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Kelas berhasil diubah');
    }
}
