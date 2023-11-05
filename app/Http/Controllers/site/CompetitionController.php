<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function showCertificateParticipationPage()
    {
        return view('site.area_atleta.certificado_participacao');
    }
    public function showCertificateVictoryPage()
    {
        return view('site.area_atleta.certificado_vitoria');
    }
}
