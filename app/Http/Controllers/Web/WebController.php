<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebController extends Controller
{
    public function uploadImage(Request $request)
    {
        $file = $request->upload;
         
        $file_name = time() . '_' . uniqid() . $file->getClientOriginalName();
        
        $path = 'files/event';
        
        Storage::put("$path/$file_name", file_get_contents($file), 'public');

        return response()->json([
            'fileName' => $file_name,
            "uploaded" => 1,
            'url' => "http://ukline.oss-ap-southeast-5.aliyuncs.com/$path/$file_name"
        ]);
    }
}
