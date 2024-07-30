<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy tất cả đơn hàng
        $donHangs = DonHang::with('chiTietDonHangs')->get();

        // Tổng số đơn hàng
        $tongDonHangs = DonHang::count();

        // Tổng tiền của tất cả đơn hàng
        $tongTien = DonHang::sum('tong_tien');

        // Tổng số đơn hàng theo trạng thái
        $donHangDangXuLy = DonHang::where('trang_thai', 'Đang xử lý')->count();
        $donHangDaGiao = DonHang::where('trang_thai', 'Đã giao')->count();
        $donHangHuy = DonHang::where('trang_thai', 'Hủy')->count();

        return view('admins.dashboard', compact('donHangs', 'tongDonHangs', 'tongTien', 'donHangDangXuLy', 'donHangDaGiao', 'donHangHuy'));
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
