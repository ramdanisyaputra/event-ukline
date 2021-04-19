<?php

namespace App\Http\Controllers\QuestionWriter;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function index(Request $request)
    {
        $exams = Exam::where('regency_id', $this->authUser()->regency_id)->where('shared','1')->get();
        $examTypes = ExamType::all();
        return view('question_writer.exams.index',compact('exams','examTypes'));
    }
   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'started_at'=>'required',
            'expired_at'=>'required',
            'duration'=>'required',
            'access_code'=>'required',
            'exam_type_id'=>'required',
            'randomized'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }
        $data['name'] = $request->name;
        $data['started_at'] = $request->started_at;
        $data['expired_at'] = $request->expired_at;
        $data['duration'] = $request->duration;
        $data['access_code'] = $request->access_code;
        $data['exam_type_id'] = $request->exam_type_id;
        $data['shared'] = 1;
        $data['randomized'] = $request->randomized;
        $data['regency_id'] = $this->authUser()->regency_id;
        Exam::create($data);
        return redirect(route('question_writer.exams.index'))->with('success','Ujian berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'started_at'=>'required',
            'expired_at'=>'required',
            'duration'=>'required',
            'access_code'=>'required',
            'exam_type_id'=>'required',
            'randomized'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data')->withInput();
        }
        $data['name'] = $request->name;
        $data['started_at'] = $request->started_at;
        $data['expired_at'] = $request->expired_at;
        $data['duration'] = $request->duration;
        $data['access_code'] = $request->access_code;
        $data['exam_type_id'] = $request->exam_type_id;
        $data['randomized'] = $request->randomized;
        Exam::find($request->id)->update($data);
        return redirect(route('question_writer.exams.index'))->with('success','Ujian berhasil diubah');
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
}
