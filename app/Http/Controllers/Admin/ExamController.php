<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\School;
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
        return view('school_admin.exams.create_public');
    }

    public function createPrivate()
    {
        return view('school_admin.exams.create_private');
    }
}
