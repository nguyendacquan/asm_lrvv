<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index()
    {
        $listUser = User::all();
        return view("admins.users.index", compact("listUser"));
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

    public function softDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Sử dụng phương thức delete() để xóa mềm

        return redirect()->route('admins.users.index')->with('success', 'Người dùng đã bị xóa mềm thành công');
    }
    public function deleted()
    {
        $deletedUsers = User::onlyTrashed()->get();

        return view('admins.users.deleted', compact('deletedUsers'));
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admins.users.deleted')->with('success', 'Khôi phục người dùng thành công');
    }

    /**
     * Force delete the specified resource from storage.
     */
    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->route('admins.users.deleted')->with('success', 'Người dùng đã bị xóa vĩnh viễn');

    }
}
