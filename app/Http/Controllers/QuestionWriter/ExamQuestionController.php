<?php

namespace App\Http\Controllers\QuestionWriter;

use App\Exports\QuestionWriterExportQuestion;
use App\Http\Controllers\Controller;
use App\Imports\QuestionWriterImportQuestion;
use App\Models\Exam;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ExamQuestionController extends Controller
{
    public function index(Exam $exam)
    {
        return view('question_writer.exams.questions.index', compact(
            'exam', 
        ));
    }

    public function create(Exam $exam)
    {
        return view('question_writer.exams.questions.create', compact('exam'));
    }

    public function store(Exam $exam, Request $request)
    {
        $validator1 = Validator::make($request->all(), [
            'question' => 'required',
            'answer' => 'required',
            'type' => 'required',
        ]);

        if ($request->type == 'PG') {
            $validator2 = Validator::make($request->all(), [
                'option' => 'required'
            ]);
        }
        if ($request->question_type == 'ESAI') {
            $validator2 = Validator::make($request->all(), [
                'poin' => 'required'
            ]);
        }
        if($validator1->fails()){
            return redirect()->back()->with('alert', 'Gagal menambahkan soal!')->withInput()->withErrors($validator1);
        }
        if($validator2->fails()){
            return redirect()->back()->with('alert', 'Gagal menambahkan soal!')->withInput()->withErrors($validator2);
        }

        $exam->examQuestions()->create([
            'question' => $request->question,
            'option' => $request->option ? json_encode($request->option) : NULL,
            'answer' => $request->answer,
            'question_type' => $request->question_type,
            'poin' => $request->poin ?? NULL
        ]);

        return redirect()->route('question_writer.exams.questions.index', $exam->id)
                        ->with('success', 'Berhasil menambahkan soal!');
    }
    
    public function pratinjau($examId)
    {
        $exam = Exam::find($examId);

        $examQuestions = ExamQuestion::where('exam_id',$examId)->get();
        return view('question_writer.exams.questions.pratinjau', compact('exam','examQuestions'));
    }
    public function edit(Exam $exam, ExamQuestion $question)
    {
        return view('question_writer.exams.questions.edit', compact('exam', 'question'));
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

        return redirect()->route('question_writer.exams.questions.index', $exam->id)
                    ->with('success', 'Berhasil mengubah soal ujian!');
     }

     public function destroy($exam, ExamQuestion $question)
     {
        $exam;

        $question->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus soal ujian!');
     }

     public function destroyAll(Exam $exam)
     {
        $exam->examQuestions()->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus semua soal ujian!');
     }
     

    public function import(Request $request, $examId)
    {
		try {
            Excel::import(new QuestionWriterImportQuestion($examId),$request->file('file'));
		} catch (\Exception $ex) {
            return back()->with('alert','adsf');
		}
        return back()->with('success','Berhasil Import Data Siswa');
    }
    public function export(Request $request, $examId)
    {
        $exam = Exam::find($examId);
		try {
            return Excel::download(new QuestionWriterExportQuestion($examId), 'Data Soal'.$exam->name.'.xlsx');
		} catch (\Exception $ex) {
            $errorMsg = json_decode($ex->getMessage());
            return back()->with('alert','Gagal export data');
		}
    }
    
    public function pdf($examId)
    {
        $exam = Exam::find($examId);

        $examQuestions = ExamQuestion::where('exam_id',$examId)->get();

        $data = compact('exam','examQuestions');

        $pdf = PDF::loadView('question_writer.exams.questions.pdf', $data);
    
        return $pdf->stream('Data Soal '.$exam->name.'.pdf');
    }
}
