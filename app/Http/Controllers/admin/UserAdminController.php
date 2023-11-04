<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function showCreateUserPage()
    {
        return view('admin.cadastrar');
    }
    public function showUpatedUserPage()
    {
        return view('admin.editar');
    }
}
