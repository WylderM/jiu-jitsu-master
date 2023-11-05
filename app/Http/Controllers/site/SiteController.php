<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function showIndexPage()
    {
        return view('site.index');
    }

    public function showTournamentPage()
    {
        return view('site.torneios');
    }

    public function showKeyListPage()
    {
        return view('site.chave_listagem');
    }

    public function showKeyCompletPage()
    {
        return view('site.chave_integra');
    }
}
