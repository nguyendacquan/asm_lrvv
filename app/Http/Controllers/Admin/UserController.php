<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index()
    {
        $listUser = User::all();
        return view("admins.users.index", compact("listUser"));
    }
    public function softDelete(Request $request, $id)
    {
        if ($request->isMethod('DELETE')) {
            $user = User::findOrFail($id);
            $user->delete(); // Xóa mềm user
            return redirect()->route('admins.users.index')->with('success', 'Xóa khách hàng thành công.');
        }
    }
    public function updateStatus(Request $request, User $user)
    {
        $user->trang_thai = $user->trang_thai === 'Hoạt động' ? 'Không hoạt động' : 'Hoạt động';
        $user->save();
        return redirect()->route('admins.users.index')->with('success', 'Cập nhật trạng thái thành công.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
