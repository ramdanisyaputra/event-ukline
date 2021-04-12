<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Support\Facades\Request;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        $school = School::all();
        return view('/superadmin/school/index',compact('school'));
    }
    public function store(Request $request)
    {
        School::create($request->all());
        return redirect()->back()->with('success','Kelas berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        School::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Kelas berhasil diubah');
    }
}
