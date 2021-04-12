<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index(Request $request)
    {
        $province = Province::all();
        return view('/superadmin/master/province/index',compact('province'));
    }
    public function store(Request $request)
    {
        Province::create($request->all());
        return redirect()->back()->with('success','Provinsi berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        Province::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Provinsi berhasil diubah');
    }
}
