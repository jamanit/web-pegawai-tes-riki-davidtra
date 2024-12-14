<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class C_auth extends Controller
{
    public function register()
    {
        return view('auth.V_register');
    }

    public function register_process(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:50',
            'email'    => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user            = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => 1,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function login()
    {
        return view('auth.V_login');
    }

    public function login_process(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|max:100',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('error', 'Kredensial yang diberikan tidak cocok dengan data kami.')->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
