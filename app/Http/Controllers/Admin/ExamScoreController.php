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

    public function deleteScoreStudent(Request $request, $id)
    {
        $examScore = ExamScore::find($id);
        $message = 'Nilai siswa '. $examScore->student->name. ' berhasil dihapus';
        $examScore->delete();
        return redirect()->back()->with('success',$message);
    }

    public function updateScore($exam, $class, ExamScore $score, Request $request)
    {
        $exam;
        $class;

        $old_details = json_decode($score->detail);
        $new_details = [];

        $new_scores = $request->scores;
        $new_total_score = 0;

        foreach ($old_details as $key => $old_detail) {
            if (isset($new_scores[$key])) {
                $old_detail->is_correct = $new_scores[$key] > 0 ? true : false;
                $new_details[] = $old_detail;
            } else {
                $new_details[] = $old_detail;
            }

            $new_total_score += $new_details[$key]->is_correct ? $new_details[$key]->poin : 0;
        }

        $score->update([
            'score' => $new_total_score,
            'detail' => json_encode($new_details)
        ]);

        return redirect()->back()->with('success', 'Memberikan nilai!');
    }

}
