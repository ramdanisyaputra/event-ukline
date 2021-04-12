<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Support\Facades\Request;

class ClassesController extends Controller
{
    public function index(Request $request)
    {
        $classes = Classes::all();
        return view('/superadmin/classes/index',compact('classes'));
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
