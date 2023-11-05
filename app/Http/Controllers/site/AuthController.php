<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginPage()
    {
        return view('site.area_atleta.login');
    }
    public function showRequestPasswordPage()
    {
        return view('site.area_atleta.recuperar_senha');
    }

    public function showForgotPasswordPage()
    {
        return view('site.area_atleta.esqueci_senha');
    }
    public function showForgotPasswordEnvitePage()
    {
        return view('site.area_atleta.esqueci_senha_enviado');
    }
}
