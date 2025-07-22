<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Method ini akan dipanggil otomatis oleh Laravel setelah login berhasil.
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'umkm') {
            return redirect()->route('/u/dashboard'); 
        } else {
        return redirect()->route('dashboard'); // fallback untuk role lain
        }

        return back()->withErrors(['email' => 'Login gagal']);
    }
}
