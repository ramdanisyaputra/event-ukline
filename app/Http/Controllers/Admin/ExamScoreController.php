<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StudentExport;
use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\ExamClass;
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

    public function export(Request $request)
    {
		try {
            return Excel::download(new StudentExport($request->id), 'Data Siswa.xlsx');
		} catch (\Exception $ex) {
            $errorMsg = json_decode($ex->getMessage());
            return back()->with('alert','Gagal export data');
		}
    }
}
