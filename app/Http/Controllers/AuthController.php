<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'USU_EMAIL' => 'required|email',
            'USU_SENHA' => 'required',
        ]);

        if (Auth::attempt(['USU_EMAIL' => $credentials['USU_EMAIL'], 'password' => $credentials['USU_SENHA']])) {
            $request->session()->regenerate();
            return redirect()->route('index');
        }

        return back()->withErrors(['USU_EMAIL' => 'Credenciais inválidas.']);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'USU_EMAIL' => 'required|email|unique:usuario,USU_EMAIL',
            'USU_SENHA' => 'required|min:6',
        ]);

        User::create([
            'USU_EMAIL' => $validated['USU_EMAIL'],
            'USU_SENHA' => Hash::make($validated['USU_SENHA']),
        ]);

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}