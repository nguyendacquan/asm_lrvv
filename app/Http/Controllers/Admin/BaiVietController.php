<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaiVietRequest;
use App\Models\BaiViet;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BaiVietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Thông tin bài viết";
        $listbaiviet = BaiViet::orderByDesc('id')->get();
        return view("admins.baiviet.index", compact("title", "listbaiviet"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $title = "Thêm bài viết";
        $listsanpham = SanPham::query()->get();
        return view("admins.baiviet.create", compact("title", "listsanpham"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BaiVietRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');

            if ($request->hasFile('hinh_anh')) {
                $params['hinh_anh'] = $request->file('hinh_anh')->store('uploads/baiviet', 'public');
            } else {
                $params['hinh_anh'] = null;
            }
            BaiViet::create($params);
          
            return redirect()->route('admins.baiviet.index')->with('success', 'Thêm bài viết thành công');
        }
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
        
        $title = "Cập nhật bài viết";
        $listsanpham = SanPham::query()->get();
        $baiviet = BaiViet::query()->findOrFail($id);
        return view("admins.baiviet.edit", compact("title", "listsanpham", "baiviet"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BaiVietRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');
            $baiviet = BaiViet::query()->findOrFail($id);
            if ($request->hasFile('hinh_anh')) {
                if ($baiviet->hinh_anh && Storage::disk('public')->exists($baiviet->hinh_anh)) {
                    Storage::disk('public')->delete($baiviet->hinh_anh);
                }
                $params['hinh_anh'] = $request->file('hinh_anh')->store('uploads/baiviet', 'public');
            } else {
                $params['hinh_anh'] = $baiviet->hinh_anh;
            }

            $baiviet->update($params);
            return redirect()->route('admins.baiviet.index')->with('success', 'Cập nhật thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $baiviet = BaiViet::query()->findOrFail($id);

        if ($baiviet->hinh_anh && Storage::disk('public')->exists($baiviet->hinh_anh)) {
            Storage::disk('public')->delete($baiviet->hinh_anh);
        }
        $baiviet->delete();
        return redirect()->route('admins.baiviet.index')->with('success', 'Xóa bài viết thành công');
    }
}
