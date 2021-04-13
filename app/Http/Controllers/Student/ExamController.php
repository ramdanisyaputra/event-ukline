<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function boarding(Exam $exam)
    {
        return view('student.exam.boarding', compact('exam'));
    }
}
