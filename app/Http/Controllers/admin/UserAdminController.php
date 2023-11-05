<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAdmin;

class UserAdminController extends Controller
{
    public function showCreateUserPage()
    {
        return view('admin.cadastrar');
    }

    public function showUpatedUserPage($id)
    {
        $user = UserAdmin::find($id);
        return view('admin.editar', compact('user'));
    }

    public function listUsers()
    {
        $users = UserAdmin::all(); // Consulta todos os registros da tabela user_admins

        return view('admin.painel', compact('users'));
    }

    public function createUserAdimin(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user_admins',
            'password' => 'required|string|confirmed',
        ]);

        $password = Hash::make($request->password);

        UserAdmin::create([
            'username' => $request->username,
            'type' => $request->type,
            'email' => $request->email,
            'password' => $password,
            'status' => 'active',
        ]);

        //return response()->json(['message' => 'Cadastro realizado com sucesso']);
        return redirect('/painel/listar-usuarios')->with('success', 'Cadastro realizado com sucesso.');
    }

    public function updateUserAdmin(Request $request, $id)
    {

        $request->validate([
            'type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user_admins,email,' . $id,
            'password' => 'nullable|string|confirmed',
        ]);

        //dd($request);

        $user = UserAdmin::find($id);


        $user->type = $request->type;
        $user->status = $request->status;
        $user->username = $request->username;
        $user->email = $request->email;


        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/painel/listar-usuarios')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function deleteUserAdmin($id)
    {
        // Recupere o usuário com base no ID
        $user = UserAdmin::find($id);

        // Verifique se o usuário existe
        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        // Exclua o usuário
        $user->delete();

        return redirect('/painel/listar-usuarios')->with('success', 'Cadastro realizado com sucesso.');
    }
}
