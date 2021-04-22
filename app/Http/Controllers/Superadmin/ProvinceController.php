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
            'name'=>'required|unique:provinces',
            'province_code'=>'required|unique:provinces',
        ], [
            'name.required' => 'Nama provinsi wajib diisi',
            'name.unique' => 'Nama provinsi telah digunakan',
            'province_code.required' => 'Kode provinsi wajib diisi',
            'province_code.unique' => 'Kode provinsi telah digunakan',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput()->withErrors($validator);
        }
        Province::create($request->all());
        return redirect()->back()->with('success','Provinsi berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|unique:provinces,name,'. $request->id,
            'province_code'=>'required|unique:provinces,province_code,'. $request->id,
        ], [
            'name.required' => 'Nama provinsi wajib diisi',
            'name.unique' => 'Nama provinsi telah digunakan',
            'province_code.required' => 'Kode provinsi wajib diisi',
            'province_code.unique' => 'Kode provinsi telah digunakan',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data')->withInput()->withErrors($validator);
        }
        Province::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Provinsi berhasil diubah');
    }
}
