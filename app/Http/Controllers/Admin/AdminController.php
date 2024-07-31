<?php

namespace App\Http\Controllers\Admin;

use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input("search");
        $listSanPham = SanPham::query()
            ->when($search, function ($query, $search) {
                return $query->where("ten_san_pham", "like", "%{$search}%");
            })->get();
        return view("admins.dashboard",compact('listSanPham'));
    }
}
