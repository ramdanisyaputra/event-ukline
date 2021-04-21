<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\ExamClass;
use App\Models\Student;
use App\Models\Subject;

class AdminController extends Controller
{
    public function index()
    {
        $subjects = Subject::where('school_id', $this->authUser()->schol_id)->count();
        $classes = Classes::where('school_id', $this->authUser()->school_id)->count();
        $students = Student::where('school_id', $this->authUser()->school_id)->count();
        $exams = ExamClass::where('school_id', $this->authUser()->school_id)->with('exam')->count();
        return view('school_admin.dashboard.index', compact('subjects','classes','students','exams'));
    }
}
