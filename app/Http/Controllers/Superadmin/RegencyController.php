<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Regency;
use Illuminate\Support\Facades\Request;

class RegencyController extends Controller
{
    public function index(Request $request)
    {
        $regency = Regency::all();
        return view('/superadmin/master/regency/index',compact('regency'));
    }
    public function store(Request $request)
    {
        Regency::create($request->all());
        return redirect()->back()->with('success','Kabupaten berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        Regency::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Kabupaten berhasil diubah');
    }
}
