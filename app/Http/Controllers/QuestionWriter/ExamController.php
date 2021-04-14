<?php

namespace App\Http\Controllers\QuestionWriter;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function index(Request $request)
    {
        $exams = Exam::where('regency_id', $this->authUser()->regency_id)->get();
        return view('question_writer.exams.index',compact('exams'));
    }
    public function create(Request $request)
    {
        $examTypes = ExamType::where('regency_id', $this->authUser()->regency_id)->get();
        return view('question_writer.exams.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'unique:provinces',
            'province_code'=>'unique:provinces',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }
        Exam::create($request->all());
        return redirect()->back()->with('success','Provinsi berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'unique:provinces,name,'. $request->id,
            'province_code'=>'unique:provinces,province_code,'. $request->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data')->withInput();
        }
        Exam::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Provinsi berhasil diubah');
    }
}
