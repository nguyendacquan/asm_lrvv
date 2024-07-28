<?php

namespace App\Http\Controllers\Client;

use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    //
    public function index()
    {
        $ClientSanPham = SanPham::get();
        return view("clients.index", compact("ClientSanPham"));
    }
    public function details(String $id)
    {
        $SanPham = SanPham::findOrFail($id);
        return view("clients.sanphams.details", compact("SanPham"));
    }
  
    public function myaccount(){
        return view("clients.account.myaccount");
    }
  
    public function cart(){
        return view("clients.thanhtoans.cart");
    }

}
