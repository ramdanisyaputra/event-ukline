<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamClass;
use App\Models\ExamScore;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        $user = auth()->guard(session()->get('role'))->user();
        $school_id = $user->school_id;
        $class_id = $user->class_id;
        $examClassess = ExamClass::where('school_id',$school_id)->get();

        $exams = [];
        foreach ($examClassess as $key => $examClass) {
            if (in_array($class_id ,json_decode($examClass->class_ids))) {
                $exam_class = $examClass->exam()
                                    ->where('status', 'published')
                                    ->whereDate('started_at', \Carbon\Carbon::now())
                                    ->first();

                if ($exam_class) {
                    array_push($exams, $exam_class);
                }
            }
        }

        return view('student.dashboard.index', compact('exams'));
    }

    public function profile()
    {
        return view('student.profile.index');
    }
}
