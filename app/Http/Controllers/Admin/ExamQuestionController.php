<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamQuestionController extends Controller
{
    public function index()
    {
        return view('school_admin.exams.questions.index');
    }
}
