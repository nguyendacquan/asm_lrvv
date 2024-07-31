<?php

namespace App\Http\Controllers\Client;

use App\Models\Banner;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input("search");
        $listSanPham = SanPham::query()
            ->when($search, function ($query, $search) {
                return $query->where("ten_san_pham", "like", "%{$search}%");
            })
            ->get();
            $listSlider = Banner::where('status', 1)->get();
           

        return view("clients.index", compact('listSanPham','listSlider'));
    }

    public function show(String $id)
    {
        $sanPham = SanPham::query()->findOrFail($id);
        $listSanPham = SanPham::query()->get();
        return view('clients.sanpham.details', compact('sanPham', 'listSanPham'));
    }

    public function shop(Request $request)
    {
        $search = $request->input("search");
        $listSanPham = SanPham::query()
            ->when($search, function ($query, $search) {
                return $query->where("ten_san_pham", "like", "%{$search}%");
            })
            ->get();
        return view('clients.sanpham.shop', compact('listSanPham'));
    }
}
