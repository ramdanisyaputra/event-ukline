<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Support\Facades\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faq = Faq::all();
        return view('/superadmin/master/faq/index',compact('faq'));
    }
    public function store(Request $request)
    {
        Faq::create($request->all());
        return redirect()->back()->with('success','Kelas berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        Faq::find($request->id)->update($request->all());
        return redirect()->back()->with('success','Kelas berhasil diubah');
    }
}
