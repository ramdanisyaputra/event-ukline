<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class ExamTypeController extends Controller
{
    public function index(Request $request)
    {
        $examType = ExamType::all();
        return view('/superadmin/master/exam-type/index',compact('examType'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }
        ExamType::create($request->all());
        return redirect()->back()->with('success','Jenis Ujian berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        ExamType::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Jenis Ujian berhasil diubah');
    }
}