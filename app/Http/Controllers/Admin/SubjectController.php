<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
class SubjectController extends Controller
{
    public function adminGuard()
    {
        $adminGuard = Auth::guard(session()->get('role'))->user();
        return $adminGuard;
    }
    public function index(Request $request)
    {
        $subject = Subject::where('school_id', $this->adminGuard()->school_id)->get();
        return view('/superadmin/subject/index',compact('subject'));
    }
    public function store(Request $request)
    {
        Subject::create($request->all());
        return redirect()->back()->with('success','Kelas berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        Subject::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Kelas berhasil diubah');
    }
}
