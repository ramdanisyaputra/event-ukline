<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Support\Facades\Request;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $grade = Grade::all();
        return view('/superadmin/master/grade/index',compact('grade'));
    }
    public function store(Request $request)
    {
        Grade::create($request->all());
        return redirect()->back()->with('success','Kelas berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        Grade::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Kelas berhasil diubah');
    }
}
