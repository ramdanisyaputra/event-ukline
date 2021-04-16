<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamType;
use App\Models\School;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamQuestionController extends Controller
{
    public function index(Exam $exam)
    {
        $examClass = $exam->examClass->first();
        $school_id = $this->authUser()->school_id;

        $class_ids = json_decode($examClass->class_ids);
        $classess = Classes::whereIn('id', $class_ids)->get();

        $subjects = Subject::where('school_id', $school_id)->get();

        $classess = Classes::where('school_id', $school_id)->get();

        $schoolStatus = School::findOrFail($school_id)->status;
        $exam_types = $schoolStatus == 'resmi' ? 
                        ExamType::where('name', 'NOT LIKE', '%tryout%')->get() :
                        ExamType::where('name', 'LIKE', '%tryout%')->get();

        return view('school_admin.exams.questions.index', compact(
            'exam', 
            'classess', 
            'subjects', 
            'classess', 
            'exam_types'
        ));
    }

    public function create(Exam $exam)
    {
        return view('school_admin.exams.questions.create', compact('exam'));
    }

    public function store(Exam $exam, Request $request)
    {
        $validator1 = Validator::make($request->all(), [
            'question' => 'required',
            'answer' => 'required',
        ]);

        if ($request->question_type == 'PG') {
            $validator2 = Validator::make($request->all(), [
                'option' => 'required'
            ]);
        }

        if ((isset($validator2) ? $validator2->fails() : false) || $validator1->fails()) {
            return redirect()->back()->with('alert', 'Gagal menambahkan soal!');
        }

        $exam->examQuestions()->create([
            'question' => $request->question,
            'option' => $request->option ? json_encode($request->option) : NULL,
            'answer' => $request->answer,
            'question_type' => $request->question_type,
            'poin' => $request->poin ?? NULL
        ]);

        return redirect()->route('school_admin.exams.questions.index', $exam->id)
                        ->with('success', 'Berhasil menambahkan soal!');
    }

    public function edit(Exam $exam, ExamQuestion $question)
    {
        return view('school_admin.exams.questions.edit', compact('exam', 'question'));
    }

    public function update(Exam $exam, ExamQuestion $question, Request $request)
    {
        if ($question->question_type == 'PG') {
            $valid = [
                'question' => 'required',
                'answer' => 'required',
                'option' => 'required',
            ];
        } elseif ($question->question_type == 'ESAI') {
            $valid = [
                'question' => 'required',
                'answer' => 'required',
                'poin' => 'required'
            ];
        }

        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('alert', 'Gagal mengubah soal ujian! Silahkan cek dan ulangi kembali, 
                        pastikan sudah terisi sesuai dengan format yang sesuai!');
        }

        $question->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'option' => $question->option ? json_encode($request->option) : NULL,
            'poin' => $request->poin ?? NULL,
        ]);

        return redirect()->route('school_admin.exams.questions.index', $exam->id)
                    ->with('success', 'Berhasil mengubah soal ujian!');
     }

     public function destroy($exam, ExamQuestion $question)
     {
        $exam;

        $question->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus soal ujian!');
     }

     public function destroyAll(Exam $exam)
     {
        $exam->examQuestions()->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus semua soal ujian!');
     }
}
