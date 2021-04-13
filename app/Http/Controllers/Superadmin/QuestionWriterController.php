<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\QuestionWriter;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class QuestionWriterController extends Controller
{
    public function index(Request $request)
    {
        $questionWriter = QuestionWriter::all();
        return view('/superadmin/school/question-writer/index',compact('questionWriter'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'username'=>'required',
            'password'=>'required',
            'regency_id'=>'required',
            'username'=>'unique:question-writers',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['password'] = bcrypt($request->password);
        $data['regency_id'] = $request->regency_id;
        QuestionWriter::create($data);
        return redirect()->back()->with('success','Penulis Soal berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'=>'unique:school_admins,username,'. $request->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data')->withInput();
        }
        QuestionWriter::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Admin sekolah berhasil diubah');
    }
}
