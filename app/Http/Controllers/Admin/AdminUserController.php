<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    //
    public function index()
    {
        $listUser = User::all();
        return view("admins.users.index", compact("listUser"));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function edit(String $id)
    {
        $title = "Cập nhật thông tin người dùng";
        $user = User::find($id);
        return view('admins.users.edit', compact('user','title'));
    }
    public function update(Request $request, String $id)
    {
        if($request->isMethod('PUT')){
            $params = $request->except('_token','_method');
            $user = User::find($id);
            $user->update($params);
            return redirect()->route('admins.users.index')->with('success', 'Cập nhật thông tin thành công');
        }
    }


    public function destroy(Request $request)
    {
        if ($request->isMethod('DELETE')) {
            $user = User::find($request->id);
            $user->delete();
            return redirect()->route('admins.users.index')->with('success', 'Xóa thành công tài khoản');
        }
    }
}
