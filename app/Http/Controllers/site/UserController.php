<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showRestrictAreaPage()
    {
        return view('site.area_atleta.area_restrita');
    }
    public function showSubscriptionPage()
    {
        return view('site.inscricao');
    }
    public function showResultPage()
    {
        return view('site.resultados');
    }
}
