<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

class AdminController
{
    public function showPainelPage()
    {
        return view('admin.painel');
    }
}
