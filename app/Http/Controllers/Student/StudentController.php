<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        $exams = Exam::all();

        return view('student.dashboard.index', compact('exams'));
    }

    public function profile()
    {
        return view('student.profile.index');
    }
}
