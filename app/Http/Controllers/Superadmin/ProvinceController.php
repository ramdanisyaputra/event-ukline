<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    public function index(Request $request)
    {
        $province = Province::all();
        return view('/superadmin/master/province/index',compact('province'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'unique:province',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput();
        }
        Province::create($request->all());
        return redirect()->back()->with('success','Provinsi berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'unique:province,name,'. $request->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data')->withInput();
        }
        Province::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Provinsi berhasil diubah');
    }
}
