<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // User
    public function user()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users', compact('users'));
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'telephone' => 'required',
            'email' => 'required',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->nim = $request->nim;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->back()->with('success', 'Data Mahasiswa berhasil diupdate');
    }
}
