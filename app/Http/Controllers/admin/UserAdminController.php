<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAdmin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class UserAdminController extends Controller
{
    public function showCreateUserPage()
    {
        if (Auth::check()) {
            // Obtém o nome do usuário autenticado
            $users = UserAdmin::all();
            $username = Auth::user()->username;
            $userInfo = Auth::user();

            return view('admin.cadastrar', compact('users', 'username', 'userInfo'));
        }
    }

    public function showUpatedUserPage($id)
    {
        $user = UserAdmin::find($id);
        $username = Auth::user()->username;
        return view('admin.editar', compact('user', 'username'));
    }

    public function listUsers()
    {
        $users = UserAdmin::all();
        $username = Auth::user()->username;
        $userInfo = Auth::user();

        return view('admin.painel', compact('users', 'username', 'userInfo'));
    }

    public function searchUsers(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');
        $de = $request->query('de');
        $ate = $request->query('ate');

        $username = Auth::user()->username;
        $userInfo = Auth::user();

        // Consulta no banco de dados com base nos filtros
        $users = UserAdmin::where(function ($query) use ($search, $status, $de, $ate) {
            if ($search) {
                $query->where('username', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            }

            if ($status) {
                $query->where('status', $status);
            }

            if ($de) {
                $query->whereDate('created_at', '>=', Carbon::createFromFormat('d/m/Y', $de)->format('Y-m-d'));
            }

            if ($ate) {
                $query->whereDate('created_at', '<=', Carbon::createFromFormat('d/m/Y', $ate)->format('Y-m-d'));
            }
        })->get();

        return view('admin.painel', ['users' => $users], compact('username', 'userInfo'));
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

        $user = UserAdmin::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        $user->delete();

        return redirect('/painel/listar-usuarios')->with('success', 'Cadastro realizado com sucesso.');
    }
}
