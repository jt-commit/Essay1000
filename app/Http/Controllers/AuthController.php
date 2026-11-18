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

            return redirect()->route('index')->with('login_sucesso', true);
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
            'USU_ESCOLARIDADE' => 'required|string|max:25',
            'USU_LOCAL-ESTUDO' => 'required|string|max:255',
        ]);

        $user = User::create([
            'USU_EMAIL' => $validated['USU_EMAIL'],
            'USU_SENHA' => Hash::make($validated['USU_SENHA']),
            'USU_ESCOLARIDADE' => $validated['USU_ESCOLARIDADE'],
            'USU_LOCAL-ESTUDO' => $validated['USU_LOCAL-ESTUDO'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('index')->with([
            'cadastro_sucesso' => true,
            'login_sucesso' => true,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
