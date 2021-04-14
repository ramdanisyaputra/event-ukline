<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\ExamClass;
use App\Models\ExamType;
use App\Models\School;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function index()
    {
        $exams = ExamClass::where('school_id', $this->authUser()->school_id)
                        ->with('exam')->get();

        return view('school_admin.exams.index', compact('exams'));
    }

    public function createPublic()
    {
        $school_id = $this->authUser()->school_id;

        $classess = Classes::where('school_id', $school_id)->get();
        $subjects = Subject::where('school_id', $school_id)->get();

        $alreadyExamIds = ExamClass::where('school_id', $school_id)
                        ->pluck('exam_id')->toArray();

        $exams = Exam::where('shared', true)
                    ->whereNotIn('id', $alreadyExamIds)->get();

        return view('school_admin.exams.create_public', compact('classess', 'subjects', 'exams'));
    }

    public function storePublic(Request $request)
    {
        $school_id = $this->authUser()->school_id;

        $validator = Validator::make($request->all(), [
            'exam_id' => 'required|exist:exams,id',
            'subject_id' => 'required',
            'class_ids' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('alert', 'Gagal menambahkan ujian!');
        }

        ExamClass::create([
            'exam_id' => $request->exam_id,
            'school_id' => $school_id,
            'subject_id' => $request->subject_id,
            'class_ids' => json_encode($request->class_ids)
        ]);

        return redirect()->route('school_admin.exams.index')->with('success', 'Berhasil menambahkan ujian!');
    }

    public function createPrivate()
    {
        $school_id = $this->authUser()->school_id;
        $schoolStatus = School::findOrFail($school_id)->status;
        $exam_types = $schoolStatus == 'resmi' ? 
                        ExamType::where('name', 'NOT LIKE', '%tryout%')->get() :
                        ExamType::where('name', 'LIKE', '%tryout%')->get();

        $subjects = Subject::where('school_id', $school_id)->get();
        $classess = Classes::where('school_id', $school_id)->get();

        return view('school_admin.exams.create_private', compact(
            'exam_types',
            'subjects',
            'classess'
        ));
    }

    public function storePrivate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'exam_type_id' => 'required',
            'subject_id' => 'required',
            'started_at' => 'required',
            'expired_at' => 'required',
            'duration' => 'required',
            'class_ids' => 'required',
            'access_code' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('alert', 'Gagal menambahkan ujian!')->withInput();
        }

        $school_id = $this->authUser()->school_id;
        $regency_id = $this->authUser()->school->id;
        
        Exam::create([
            'name' => $request->name,
            'exam_type_id' => $request->exam_type_id,
            'started_at' => $request->started_at,
            'expired_at' => $request->expired_at,
            'duration' => $request->duration,
            'shared' => false,
            'regency_id' => $regency_id,
            'access_code' => $request->access_code,
        ])->examClass()->create([
            'school_id' => $school_id,
            'subject_id' => $request->subject_id,
            'class_ids' => json_encode($request->class_ids)
        ]);

        return redirect()->route('school_admin.exams.index')->with('success', 'Berhasil menambahkan ujian mandiri!');
    }
}
