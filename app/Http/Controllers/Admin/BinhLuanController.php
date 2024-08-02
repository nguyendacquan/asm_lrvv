<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BinhLuan;
use App\Models\SanPham;
use Illuminate\Http\Request;

class BinhLuanController extends Controller
{
    //
    public function index($san_pham_id)
    {
        $sanPham = SanPham::with('binhLuans.nguoiDung')->findOrFail($san_pham_id);
        return view('admins.sanphams.binhluan', compact('sanPham'));
    }

    public function destroy($id)
    {
        $binhLuan = BinhLuan::findOrFail($id);
        $binhLuan->delete();
        return redirect()->back()->with('success', 'Bình luận đã được xóa thành công.');
    }
}
