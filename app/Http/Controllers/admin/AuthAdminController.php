<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AuthAdminController extends Controller
{
    public function showLoginPage()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->session()->regenerate();
        $email = $request->input('email');
        $senha = $request->input('senha');

        $data = $request->json()->all();

        dd($data);
        return response()->json(['message' => 'Login bem-sucedido']);
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
