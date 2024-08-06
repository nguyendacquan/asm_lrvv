<?php

namespace App\Http\Controllers\Admin;

use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listdonHang = DonHang::query()->orderByDesc('id')->get();
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        $type_huy_don_hang = DonHang::HUY_DON_HANG;

        return view('admins.donhangs.index', compact('listdonHang', 'trangThaiDonHang', 'type_huy_don_hang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donHang = DonHang::query()->findOrFail($id);
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        $trangThaiThanhToan = DonHang::TRANG_THAI_THANH_TOAN;
        return view('admins.donhangs.show', compact('donHang', 'trangThaiDonHang', 'trangThaiThanhToan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $donHang = DonHang::query()->findOrFail($id);
        $currentTrangThai = $donHang->trang_thai_don_hang;
        $newTrangThai = $request->input('trang_thai_don_hang');

        $trangThais = array_keys(DonHang::TRANG_THAI_DON_HANG);
        // kiem tra trang thai don hang da huy thi khong duoc thay doi trang tahi nua
        if ($currentTrangThai === DonHang::HUY_DON_HANG) {
            return redirect()->route('admins.donhangs.index')->with('error', 'Đơn hàng đã bị ủy không thể thay đổi trạng thái');
        }

        // kiem tra neu trang thai moi khong duoc nam sau trang thai hien tai
        if (array_search($newTrangThai, $trangThais) < array_search($currentTrangThai, $trangThais)) {
            return redirect()->route('admins.donhangs.index')->with('error', 'Không thể cập nhật ngược lại trạng thái');
        }

        $donHang->trang_thai_don_hang = $newTrangThai;
        $donHang->save();
        return redirect()->route('admins.donhangs.index')->with('success', 'Cập nhật trạng thái thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $donHang = DonHang::query()->findOrFail($id);
    
        if ($donHang && $donHang->trang_thai_don_hang == DonHang::HUY_DON_HANG) {
            $donHang->chiTietDonHang()->delete();
            $donHang->delete(); // Sử dụng phương thức delete() để xóa mềm
            return redirect()->back()->with('success', 'Bạn đã xóa thành công');
        }
        return redirect()->back()->with('error', 'Không thể xóa được đơn hàng');
    }
    public function deleted()
    {
        $deletedDonHangs = DonHang::onlyTrashed()->get();
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;

        return view('admins.donhangs.donhangdaxoa', compact('deletedDonHangs', 'trangThaiDonHang'));
    }

    public function restore($id)
    {
        $donHang = DonHang::withTrashed()->findOrFail($id);
        $donHang->restore();

        return redirect()->route('admins.donhangs.deleted')->with('success', 'Khôi phục đơn hàng thành công');
    }

    public function forceDelete($id)
    {
        $donHang = DonHang::withTrashed()->findOrFail($id);
        $donHang->forceDelete();

        return redirect()->route('admins.donhangs.deleted')->with('success', 'Đơn hàng đã bị xóa vĩnh viễn');
    }
}
