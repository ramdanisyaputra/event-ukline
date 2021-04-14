<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\School;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $exams = School::find($this->authUser()->school_id)->examClass;
        return view('school_admin.exams.index', compact('exams'));
    }

    public function createPublic()
    {
        $classess = Classes::where('school_id', $this->authUser()->school_id)->get();
        $subjects = Subject::where('school_id', $this->authUser()->school_id)->get();
        $exams = Exam::where('shared', true)->get();

        return view('school_admin.exams.create_public', compact('classess', 'subjects', 'exams'));
    }

    public function createPrivate()
    {
        return view('school_admin.exams.create_private');
    }
}
