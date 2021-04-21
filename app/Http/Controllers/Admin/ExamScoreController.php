<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ScoreExport;
use App\Exports\StudentExport;
use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\ExamClass;
use App\Models\ExamQuestion;
use App\Models\ExamScore;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Excel;


class ExamScoreController extends Controller
{
    public function index(Request $request)
    {
        $examClass = ExamClass::where('school_id', $this->authUser()->school_id)->get();
        return view('school_admin.exams.exam-scores.index',compact('examClass'));
    }

    public function indexScore($examId)
    {
        $exam = Exam::find($examId);
        $examClass = ExamClass::where('exam_id',$examId)->first();
        return view('school_admin.exams.exam-scores.index-score',compact('exam','examClass'));
    }

    public function indexScoreExam(Exam $exam, Classes $class)
    {

        return view('school_admin.exams.exam-scores.index-score-exam', 
                    compact('exam','class'));
    }

    public function exportExam(Exam $exam, Classes $class)
    {
        return Excel::download(new ScoreExport($class,$exam), "Nilai $exam->name $class->name.xlsx");
    }

    public function detail(Exam $exam, Classes $class,ExamScore $score)
    {
        $examQuestions = ExamQuestion::where('exam_id',$exam)->get();
        return view('school_admin.exams.exam-scores.detail', 
                    compact('exam','class','score','examQuestions'));
    }

}
