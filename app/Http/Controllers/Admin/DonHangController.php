<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = DonHang::query();
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('id', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
        }
    
        $donHangs = $query->with('user')->paginate(10);
    
        return view('admins.donhang.donhang', compact('donHangs'));
    }

    public function show($id)
    {
        $donHang = DonHang::with('user', 'chiTietDonHangs.sanPham')->findOrFail($id);
        return view('admins.donhang.chitietdonhang', compact('donHang'));
    }
    public function update(Request $request, $id)
    {
        $donHang = DonHang::findOrFail($id);
        $donHang->update($request->only('trang_thai'));
        return redirect()->route('admins.chitietdonhang', $id)->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }
}
