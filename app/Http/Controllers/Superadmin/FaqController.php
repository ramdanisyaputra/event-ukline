<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faq = Faq::all();
        return view('/superadmin/master/faq/index',compact('faq'));
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
        Faq::create($request->all());
        return redirect()->back()->with('success','Kelas berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        Faq::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Kelas berhasil diubah');
    }
}
