<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    public function index(Request $request)
    {
        $provinces = Province::all();
        return view('superadmin.provinces.index',compact('provinces'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'unique:provinces',
            'province_code'=>'unique:provinces',
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
            'name'=>'unique:provinces,name,'. $request->id,
            'province_code'=>'unique:provinces,province_code,'. $request->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data')->withInput();
        }
        Province::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Provinsi berhasil diubah');
    }
}
