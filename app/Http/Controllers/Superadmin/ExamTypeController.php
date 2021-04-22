<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamTypeController extends Controller
{
    public function index(Request $request)
    {
        $examTypes = ExamType::all();
        return view('superadmin.exam-types.index',compact('examTypes'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|unique:exam_types',
        ], [
            'name.required' => 'Tipe ujian wajib diisi',
            'name.unique' => 'Tipe ujian telah digunakan',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput()->withErrors($validator);
        }
        ExamType::create($request->all());
        return redirect()->back()->with('success','Jenis Ujian berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|unique:exam_types,name,'.$request->id,
        ], [
            'name.required' => 'Tipe ujian wajib diisi',
            'name.unique' => 'Tipe ujian telah digunakan',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data')->withInput()->withErrors($validator);
        }
        ExamType::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Jenis Ujian berhasil diubah');
    }
}
