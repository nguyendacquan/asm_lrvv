<?php

namespace App\Http\Controllers\Client;

use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DanhMuc;

class ClientController extends Controller
{
    //
    public function index()
    {
        $listSanPham = SanPham::query()->get();
       
        return view("clients.index", compact('listSanPham'));
    }

    public function show($id)
    {
        $SanPham = SanPham::findOrFail($id);
        return view('clients.sanpham.details', compact('SanPham'));

    }
}
