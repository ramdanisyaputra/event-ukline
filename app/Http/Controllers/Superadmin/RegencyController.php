<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegencyController extends Controller
{
    public function index(Request $request)
    {
        $regencies = Regency::all();
        $provinces = Province::all();
        return view('superadmin.regencies.index',compact('regencies', 'provinces'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'regency_code'=>'required|unique:regencies',
            'province_id'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data!');
        }
        Regency::create($request->all());
        return redirect()->back()->with('success','Kabupaten berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'regency_code'=>'required|unique:regencies,regency_code,' . $request->id,
            'province_id'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data!');
        }
        Regency::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Kabupaten berhasil diubah');
    }
}
