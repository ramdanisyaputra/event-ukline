<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\ExamClass;
use App\Models\ExamQuestion;
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

    public function updateStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('alert', 'Gagal mengubah status! Silahkan ulangi kembali.');
        }
        $exam = Exam::find($request->id);

        if($exam->status == 'drafted'){

            $examQuestion = ExamQuestion::where('exam_id',$request->id)->get();
            if(count($examQuestion) == 0){
                return redirect()->back()->with('alert','Soal masih kosong');
            }
            $essay = ExamQuestion::where('exam_id',$request->id)
                        ->where('question_type','ESAI')
                        ->sum('poin');

            $pg = ExamQuestion::where('exam_id',$request->id)->where('question_type', 'PG')->get();
            $hitung = 100 - $essay;

            $hasil = $hitung / count($pg);
                foreach ($examQuestion as $value) {
                    ExamQuestion::where('id',$value->id)->where('question_type', 'PG')->update([
                        'poin'=>round($hasil,2)
                    ]);
                }

            $exam->update([
                'status'=>'published'
            ]);

            return redirect()->back()->with('success','Soal berhasil di Publikasikan');
        }else{
            $exam->update([
                'status'=>'drafted'
            ]);
            ExamQuestion::where('exam_id',$request->id)->where('question_type', 'PG')->update([
                'poin'=>null
            ]);
            return redirect()->back()->with('success','Soal berhasil di Arsipkan');
        }
        return redirect()->back()->with('success', "Berhasil mengubah status!");
    }

    public function update(Request $request)
    {
        if (!$request->shared) {
            $validator1 = Validator::make($request->all(), [
                'name' => 'required',
                'exam_type_id' => 'required',
                'started_at' => 'required',
                'expired_at' => 'required',
                'duration' => 'required',
                'access_code' => 'required'
            ]);
        }

        $validator2 = Validator::make($request->all(), [
            'id' => 'required',
            'shared' => 'required',
            'subject_id' => 'required',
            'class_ids' => 'required'
        ]);

        if ((isset($validator1) ? $validator1->fails() : false) || 
            $validator2->fails()) {
            return redirect()->back()->with('alert', 'Gagal mengubah ujian');
        }

        $examClass = ExamClass::where('exam_id', $request->id)
                ->where('school_id', $this->authUser()->school_id)
                ->first();

        $examClass->update([
            'subject_id' => $request->subject_id,
            'class_ids' => json_encode($request->class_ids)
        ]);

        if (!$request->shared) {
            $exam  = Exam::find($request->id)->update([
                'name' => $request->name,
                'exam_type_id' => $request->exam_type_id,
                'started_at' => $request->started_at,
                'expired_at' => $request->expired_at,
                'duration' => $request->duration,
                'access_code' => $request->access_code,
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil mengubah ujian!');

    }
}
