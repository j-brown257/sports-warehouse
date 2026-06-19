<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'userName' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'))
                ->with('status', 'Welcome back, ' . Auth::user()->userName . '!');
        }

        return back()->withErrors([
            'userName' => 'Those credentials do not match our records.',
        ])->onlyInput('userName');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('status', 'You have been logged out.');
    }

    public function showChangePassword()
    {
        return view('auth.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password'     => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->route('account.password')->with('status', 'Your password has been updated.');
    }

}