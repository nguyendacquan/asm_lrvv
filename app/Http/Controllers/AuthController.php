<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function showFormlogin(Request $request)
    {
        return view("auth.login");
    }
    public function login(Request $request)
    {

        $user = $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string',
        ]); // check password database
        // dd($user);
        if (Auth::attempt($user)) { // kiem tra neu dung thi ban ve home
            return redirect()->intended('admins/dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Thông tin người dùng không đúng !']);
    }


    public function showFormRegister(Request $request)
    {

        return view("auth.register");
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        $user = User::query()->create($data);
        Auth::login($user);
        return redirect()->intended('home');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/client');
    }
}
