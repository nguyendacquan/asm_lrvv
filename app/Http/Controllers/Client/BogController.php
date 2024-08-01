<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\BaiViet;
use Illuminate\Http\Request;

class BogController extends Controller
{
    
    public function blog(Request $request){
        $blog = BaiViet::get();
        return view("clients.blogs.index", compact("blog"));
    }
}
