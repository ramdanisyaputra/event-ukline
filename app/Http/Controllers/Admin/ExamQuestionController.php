<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportQuestion;
use App\Http\Controllers\Controller;
use App\Imports\AdminImportQuestion;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamScore;
use App\Models\ExamType;
use App\Models\School;
use App\Models\Subject;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ExamQuestionController extends Controller
{
    public function index(Exam $exam)
    {
        $examClass = $exam->examClass->first();
        $school_id = $this->authUser()->school_id;

        $class_ids = json_decode($examClass->class_ids);
        $selectedClassess = Classes::whereIn('id', $class_ids)->get();

        $subjects = Subject::where('school_id', $school_id)->get();

        $classess = Classes::where('school_id', $school_id)->get();

        $schoolStatus = School::findOrFail($school_id)->status;
        $exam_types = $schoolStatus == 'resmi' ? 
                        ExamType::where('name', 'NOT LIKE', '%tryout%')->get() :
                        ExamType::where('name', 'LIKE', '%tryout%')->get();

        return view('school_admin.exams.questions.index', compact(
            'exam',
            'selectedClassess',
            'classess', 
            'subjects', 
            'classess', 
            'exam_types'
        ));
    }

    public function create(Exam $exam)
    {
        return view('school_admin.exams.questions.create', compact('exam'));
    }

    public function store(Exam $exam, Request $request)
    {
        $validator1 = Validator::make($request->all(), [
            'question' => 'required',
            'answer' => 'required',
        ]);

        if ($request->question_type == 'PG') {
            $validator2 = Validator::make($request->all(), [
                'option' => 'required'
            ]);
        }

        if ((isset($validator2) ? $validator2->fails() : false) || $validator1->fails()) {
            return redirect()->back()->with('alert', 'Gagal menambahkan soal!');
        }

        $exam->examQuestions()->create([
            'question' => $request->question,
            'option' => $request->option ? json_encode($request->option) : NULL,
            'answer' => $request->answer,
            'question_type' => $request->question_type,
            'poin' => $request->poin ?? NULL
        ]);

        return redirect()->route('school_admin.exams.questions.index', $exam->id)
                        ->with('success', 'Berhasil menambahkan soal!');
    }

    public function pratinjau($examId)
    {
        $exam = Exam::find($examId);

        $examQuestions = ExamQuestion::where('exam_id',$examId)->get();
        return view('school_admin.exams.questions.pratinjau', compact('exam','examQuestions'));
    }   

    public function pdf($examId)
    {
        $exam = Exam::find($examId);

        $examQuestions = ExamQuestion::where('exam_id',$examId)->get();
        $data = compact('exam','examQuestions');
        
        $pdf = PDF::loadView('school_admin.exams.questions.pdf', $data);
    
        return $pdf->stream('Data Soal '.$exam->name.'.pdf');
    }

   

    public function edit(Exam $exam, ExamQuestion $question)
    {
        $schoolId = $this->authUser()->school_id;
        $scores = ExamScore::where('exam_id', $exam->id)->where('school_id',$schoolId)->count();
        if($scores > 0){
            return redirect()->back()->with('alert','Soal tidak dapat di edit, karena telah terdapat nilai siswa yang sudah mengerjakan.');
        }
        return view('school_admin.exams.questions.edit', compact('exam', 'question'));
    }

    public function update(Exam $exam, ExamQuestion $question, Request $request)
    {
        if ($question->question_type == 'PG') {
            $valid = [
                'question' => 'required',
                'answer' => 'required',
                'option' => 'required',
            ];
        } elseif ($question->question_type == 'ESAI') {
            $valid = [
                'question' => 'required',
                'answer' => 'required',
                'poin' => 'required'
            ];
        }

        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('alert', 'Gagal mengubah soal ujian! Silahkan cek dan ulangi kembali, 
                        pastikan sudah terisi sesuai dengan format yang sesuai!');
        }

        $question->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'option' => $question->option ? json_encode($request->option) : NULL,
            'poin' => $request->poin ?? NULL,
        ]);

        return redirect()->route('school_admin.exams.questions.index', $exam->id)
                    ->with('success', 'Berhasil mengubah soal ujian!');
     }

     public function destroy($exam, ExamQuestion $question)
     {
        $exam;
        $schoolId = $this->authUser()->school_id;
        $scores = ExamScore::where('exam_id', $exam)->where('school_id',$schoolId)->count();
        if($scores > 0){
            return redirect()->back()->with('alert','Soal tidak dapat di hapus, karena telah terdapat nilai siswa yang sudah mengerjakan.');
        }
        $question->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus soal ujian!');
     }

     public function destroyAll(Exam $exam)
     {
        $schoolId = $this->authUser()->school_id;
        $scores = ExamScore::where('exam_id', $exam->id)->where('school_id',$schoolId)->count();
        if($scores > 0){
            return redirect()->back()->with('alert','Soal tidak dapat di hapus, karena telah terdapat nilai siswa yang sudah mengerjakan.');
        }
        $exam->examQuestions()->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus semua soal ujian!');
     }
    public function import(Request $request, $examId)
    {
		try {
            Excel::import(new AdminImportQuestion($examId),$request->file('file'));
		} catch (\Exception $ex) {
            return back()->with('alert','adsf');
		}
        return back()->with('success','Berhasil Import Data Siswa');
    }
    public function export(Request $request, $examId)
    {
        $exam = Exam::find($examId);
		try {
            return Excel::download(new ExportQuestion($examId), 'Data Soal '.$exam->name.'.xlsx');
		} catch (\Exception $ex) {
            $errorMsg = json_decode($ex->getMessage());
            return back()->with('alert','Gagal export data');
		}
    }
}
