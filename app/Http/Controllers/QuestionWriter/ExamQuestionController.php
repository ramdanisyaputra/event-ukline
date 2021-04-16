<?php

namespace App\Http\Controllers\QuestionWriter;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\School;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamQuestionController extends Controller
{
    public function index(Exam $exam)
    {
        return view('question_writer.exams.questions.index', compact(
            'exam', 
        ));
    }

    public function create(Exam $exam)
    {
        return view('question_writer.exams.questions.create', compact('exam'));
    }

    public function store(Exam $exam, Request $request)
    {
        $validator1 = Validator::make($request->all(), [
            'question' => 'required',
            'answer' => 'required',
            'question_type' => 'required',
        ]);

        if ($request->question_type == 'PG') {
            $validator2 = Validator::make($request->all(), [
                'option' => 'required'
            ]);
        }
        if ($request->question_type == 'ESAI') {
            $validator2 = Validator::make($request->all(), [
                'poin' => 'required'
            ]);
        }
        if($validator1->fails()){
            return redirect()->back()->with('alert', 'Gagal menambahkan soal!')->withInput()->withErrors($validator1);
        }
        if($validator2->fails()){
            return redirect()->back()->with('alert', 'Gagal menambahkan soal!')->withInput()->withErrors($validator2);
        }

        $exam->examQuestions()->create([
            'question' => $request->question,
            'option' => $request->option ? json_encode($request->option) : NULL,
            'answer' => $request->answer,
            'question_type' => $request->question_type,
            'poin' => $request->poin ?? NULL
        ]);

        return redirect()->route('question_writer.exams.questions.index', $exam->id)
                        ->with('success', 'Berhasil menambahkan soal!');
    }
}
