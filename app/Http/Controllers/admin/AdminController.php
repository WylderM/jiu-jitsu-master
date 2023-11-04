<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AdminController
{
    public function showPainelPage()
    {
        return view('admin.painel');
    }
}
