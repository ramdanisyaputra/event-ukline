<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\School;
use App\Models\Subject;
use Illuminate\Http\Request;

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
}
