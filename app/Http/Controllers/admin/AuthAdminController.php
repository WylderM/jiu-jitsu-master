<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;


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

            Auth::login($user);

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

        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = UserAdmin::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'E-mail não encontrado.');
        }


        return view('admin.recuperar-senha');
        /*
            A funcionalidade abaixo está praticamente feita, porém precisa configurar um serviço de
            smtp, opós configurar esse serviço a função irá funcionar corretamente.
        */

        // $response = Password::broker('user_admins')->sendResetLink(
        //     $request->only('email')
        // );

        // return $response == Password::RESET_LINK_SENT
        //     ? redirect()->back()->with('status', 'Link de redefinição de senha enviado!')
        //     : redirect()->back()->with('error', 'Erro ao enviar o link de redefinição de senha.');
    }
}
