<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function ceklogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect("/home");
        } else {
            return redirect("/");
        }
    }

    public function ceklogout()
    {
        Auth::logout();
        return redirect("/");
    }

    public function updateuser(Request $request)
    {
        // Validasi input
        $request->validate([
            'password_lama' => 'required|string',
            'password_baru' => 'required|string|min:6|confirmed',
        ]);

        // Mengambil user yang sedang login
        $user = Auth::user();

        // Memeriksa apakah password lama benar
        if (Hash::check($request->password_lama, $user->password)) {
            // Mengupdate password
            $user->password = Hash::make($request->password_baru);
            $user->save();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Password berhasil diperbarui.');
        } else {
            // Redirect dengan pesan error
            return redirect()->back()->withErrors(['password_lama' => 'Password lama salah.']);
        }
    }
}
