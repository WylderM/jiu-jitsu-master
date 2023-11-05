<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



use App\Models\UserAdmin;

class AuthAdminController extends Controller
{
    public function showLoginPage()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = UserAdmin::where('email', $request->email)->first();

        if ($user && $user->validateCredentials($request->only('password'))) {
            // As credenciais são válidas, autentique o usuário
            Auth::login($user); // Isso autenticará o usuário

            return redirect('/painel/listar-usuarios');
        } else {
            return back()->withErrors(['email' => 'Credenciais inválidas'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/painel/login');
    }

    public function showRequestPasswordPage()
    {
        return view('admin.recuperar-senha');
    }

    public function requestPassword(Request $request)
    {
        return response()->json(['message' => 'Request password']);
    }
}
