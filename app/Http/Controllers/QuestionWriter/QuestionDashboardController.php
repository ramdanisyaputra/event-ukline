<?php

namespace App\Http\Controllers\QuestionWriter;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\School;
use App\Models\SchoolAdmin;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class QuestionDashboardController extends Controller
{
    public function index()
    {
        $role = session()->get('role');
        $regency_id = auth()->guard($role)->user()->regency_id;
        $school_ids = School::where('regency_id', $regency_id)->get('id')->toArray();
        $school_total = count($school_ids);
        $exam_total = Exam::where('regency_id', $regency_id)->count();
        $student_total = Student::whereIn('school_id', $school_ids)->count();
        $admin_total = SchoolAdmin::whereIn('school_id', $school_ids)->count();

        return view('question_writer.dashboard.index', compact(
            'school_total',
            'exam_total',
            'student_total',
            'admin_total'
        ));
    }
}
