<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function edit()
    {
        $user = Auth::user(); // Lấy thông tin người dùng hiện tại
        return view('clients.myaccount.myaccount', compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user(); // Lấy người dùng hiện tại

        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'gioi_tinh' => 'required|string|max:255',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_pwd' => 'required|string',
            'new_pwd' => 'nullable|string|min:6|confirmed',
        ]);

        // Cập nhật thông tin người dùng
        $user->name = $request->name;
        $user->gioi_tinh = $request->gioi_tinh;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->ngay_sinh = $request->ngay_sinh;

        // Xử lý tải lên hình ảnh
        if ($request->hasFile('hinh_anh')) {
            // Xóa hình ảnh cũ nếu có
            if ($user->hinh_anh) {
                Storage::delete($user->hinh_anh);
            }
            // Lưu hình ảnh mới
            $path = $request->file('hinh_anh')->store('avatars', 'public');
            $user->hinh_anh = $path;
        }

        // Cập nhật mật khẩu nếu người dùng cung cấp mật khẩu hiện tại
        if (password_verify($request->current_pwd, $user->password)) {
            if ($request->new_pwd) {
                $user->password = bcrypt($request->new_pwd);
            }
        } else {
            return back()->withErrors(['current_pwd' => 'Mật khẩu hiện tại không đúng.']);
        }

        // Lưu các thay đổi
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Cập nhật tài khoản thành công.');
    }
}
