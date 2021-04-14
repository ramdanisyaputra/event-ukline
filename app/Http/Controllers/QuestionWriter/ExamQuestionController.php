<?php

namespace App\Http\Controllers\QuestionWriter;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamQuestionController extends Controller
{
    public function index($id)
    {
        $examQuestions = ExamQuestion::where('exam_id',$id)->get();
        return view('question_writer.question_exams.index',compact('examQuestions'));
    }
    public function create(Request $request)
    {
        $examTypes = ExamType::all();
        
        return view('question_writer.question_exams.create', compact('examTypes'));
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
    public function edit($id)
    {
        $exam = Exam::find($id);
        $examTypes = ExamType::all();
        return view('question_writer.exams.edit', compact('exam','examTypes'));
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