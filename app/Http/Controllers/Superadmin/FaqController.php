<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faqs = Faq::all();
        $tags = Tag::all();
        return view('superadmin.faq.index',compact('faqs','tags'));
    }
    public function edit($id)
    {
        $faq = Faq::find($id);
        $tags = Tag::all();
        return view('superadmin.faq.edit',compact('faq','tags'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tags'=>'required',
            'question'=>'required',
            'answer'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }
        $data['tags'] = json_encode($request->tags);
        $data['question'] = $request->question;
        $data['answer'] = $request->answer;

        Faq::create($data);
        return redirect()->back()->with('success','Kelas berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tags'=>'required',
            'question'=>'required',
            'answer'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }
        $data['question'] = $request->question;
        $data['answer'] = $request->answer;
        $data['tags'] = json_encode($request->tags);
        Faq::find($request->id)->update($data);
        return redirect(route('superadmin.faqs.index'))->with('success','Kelas berhasil diubah');
    }
}
