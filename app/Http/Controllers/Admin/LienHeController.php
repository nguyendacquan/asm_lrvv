<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\lien_he;
use App\Models\LienHe;
use Illuminate\Http\Request;

class LienHeController extends Controller
{
    //

    public function index()
    {
        $listLienHe = lien_he::get();
        return view("admins.lienhes.index", compact("listLienHe"));
    }
}
