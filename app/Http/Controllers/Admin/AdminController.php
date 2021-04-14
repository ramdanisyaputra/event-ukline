<?php

namespace App\Http\Controllers\QuestionWriter;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('question_writer.dashboard.index');
    }
}
