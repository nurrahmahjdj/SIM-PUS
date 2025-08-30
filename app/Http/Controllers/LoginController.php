<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index(){
        $notif = false;

        return view('login.index', [
            'title'=> 'Login',
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'npm' => ['required'],
            'password' => ['required'],
        ]);

        $isAdmin = User::where('npm', $request->npm)->get()->contains('is_admin', '1');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ($isAdmin) {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/');
            }
        }

        return back()->with('loginError', 'Login Gagal!');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
