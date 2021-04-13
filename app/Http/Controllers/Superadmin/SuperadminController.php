<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SchoolAdmin;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function index()
    {
        $total_superadmin = User::count();
        $total_school = School::count();
        $total_school_admin = SchoolAdmin::count();
        $total_student = Student::count();

        return view('superadmin.dashboard.index', compact('total_superadmin', 'total_school', 'total_school_admin', 'total_student'));
    }
}
