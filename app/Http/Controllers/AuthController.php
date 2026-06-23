<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByPerfil();
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],
            [
                'email.required' => 'Informe o e-mail.',
                'email.email' => 'Informe um e-mail válido.',
                'password.required' => 'Informe a senha.',
            ]
        );

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'email' => 'E-mail ou senha inválidos.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return $this->redirectByPerfil();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function redirectByPerfil()
    {
        $perfil = Auth::user()->perfil;

        if ($perfil === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($perfil === 'consultante') {
            return redirect()->route('consultante.dashboard');
        }

        Auth::logout();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'Perfil de usuário inválido.',
            ]);
    }
}