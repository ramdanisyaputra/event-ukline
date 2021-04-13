<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\QuestionWriter;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionWriterController extends Controller
{
    public function index(Request $request)
    {
        $regencies = Regency::all();
        return view('superadmin.question-writers.index',compact('regencies'));
    }
    public function indexWriter($regencyId)
    {
        $questionWriters = QuestionWriter::where('regency_id',$regencyId)->get();
        $regency=Regency::find($regencyId);
        return view('superadmin.question-writers.index-writer',compact('questionWriters','regency'));
    }
    public function store(Request $request , $regencyId)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'username'=>'required',
            'password'=>'required',
            'username'=>'unique:question_writers',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['password'] = bcrypt($request->password);
        $data['regency_id'] = $regencyId;
        QuestionWriter::create($data);
        return redirect()->back()->with('success','Penulis Soal berhasil ditambahkan');
    }
    public function update(Request $request, $regencyId)
    {
        $validator = Validator::make($request->all(), [
            'username'=>'unique:school_admins,username,'. $request->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data')->withInput();
        }
        $questionWriter = QuestionWriter::find($request->id);
        $questionWriter->name = $request->name;
        $questionWriter->username = $request->username;
        $questionWriter->regency_id = $regencyId;
        $questionWriter->save();

        return redirect()->back()->with('success','Admin sekolah berhasil diubah');
    }

    public function resetPasswordWriter($regencyId,$questionWriterId)
    {
        dd($questionWriterId);
    }
}
