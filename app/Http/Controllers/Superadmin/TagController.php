<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::all();
        return view('superadmin.tags.index',compact('tags'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|unique:tags',
        ],[
            'name.required' => 'Nama tag wajib diisi',
            'name.unique' => 'Nama tag telah digunakan',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput()->withErrors($validator);
        }
        Tag::create($request->all());
        return redirect()->back()->with('success','Tag berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|unique:tags,name,'.$request->id,
        ],[
            'name.required' => 'Nama tag wajib diisi',
            'name.unique' => 'Nama tag telah digunakan',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput()->withErrors($validator);
        }
        Tag::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Tag berhasil diubah');
    }
}
