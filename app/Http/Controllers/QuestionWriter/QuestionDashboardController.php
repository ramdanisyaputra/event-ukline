<?php

namespace App\Http\Controllers\QuestionWriter;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SchoolAdmin;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class QuestionDashboardController extends Controller
{
    public function index()
    {
        return view('question_writer.dashboard.index');
    }
}
