<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    //
    public function showLogin()
    {
        return view('auth.login');
    }
    public function showRegister()
    {
        return view('auth.register');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            return redirect('/dashboard');
        }
        return back()->with('error', 'Login Gagal');
    }

    public function register(Request $request)
    {
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        return redirect('/login');
    }

    public function Logout()
    {
        Auth::logout();
        return redirect(('login'));
    }
}
