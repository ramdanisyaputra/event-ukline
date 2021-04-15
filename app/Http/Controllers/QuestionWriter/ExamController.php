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
        $examTypes = ExamType::all();
        return view('question_writer.exams.index',compact('exams','examTypes'));
    }
   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'started_at'=>'required',
            'expired_at'=>'required',
            'duration'=>'required',
            'access_code'=>'required',
            'exam_type_id'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }
        $data['name'] = $request->name;
        $data['started_at'] = $request->started_at;
        $data['expired_at'] = $request->expired_at;
        $data['duration'] = $request->duration;
        $data['access_code'] = $request->access_code;
        $data['exam_type_id'] = $request->exam_type_id;
        $data['shared'] = 1;
        $data['regency_id'] = $this->authUser()->regency_id;
        Exam::create($data);
        return redirect(route('question_writer.exams.index'))->with('success','Ujian berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'started_at'=>'required',
            'expired_at'=>'required',
            'duration'=>'required',
            'access_code'=>'required',
            'exam_type_id'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data')->withInput();
        }
        $data['name'] = $request->name;
        $data['started_at'] = $request->started_at;
        $data['expired_at'] = $request->expired_at;
        $data['duration'] = $request->duration;
        $data['access_code'] = $request->access_code;
        $data['exam_type_id'] = $request->exam_type_id;
        Exam::find($request->id)->update($data);
        return redirect(route('question_writer.exams.index'))->with('success','Ujian berhasil diubah');
    }
}
