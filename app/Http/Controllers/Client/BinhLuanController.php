<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\BinhLuan;
use App\Models\SanPham;
use Illuminate\Http\Request;

class BinhLuanController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'san_pham_id' => 'required|exists:san_phams,id',
            'noi_dung' => 'required|string',
            'danh_gia' => 'required|integer|min:1|max:5',
        ]);

        BinhLuan::create([
            'nguoi_dung_id' => auth()->id(),
            'san_pham_id' => $request->san_pham_id,
            'noi_dung' => $request->noi_dung,
            'danh_gia' => $request->danh_gia,
        ]);

        return redirect()->back();
    }

    public function show($id)
    {
        $sanPham = SanPham::with('binhLuans.nguoiDung')->findOrFail($id);
        return view('san_pham.show', compact('sanPham'));
    }
}
