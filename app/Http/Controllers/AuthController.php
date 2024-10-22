<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if (Auth::user()->role == 'user') {
                return redirect()->route('user.dashboard');
            } else {
                return redirect()->route('login')->with('error', 'Login failed, please try again');
            }
        }

        return redirect()->route('login')->with('error', 'Login failed, please try again');
    }

    public function register()
    {
        return view('register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required|unique:users',
            'telephone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->nim = $request->nim;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user';
        $user->save();

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('login')->with('success', 'Register success, please login');
        }

        return redirect()->route('register')->with('error', 'Register failed, please try again');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
