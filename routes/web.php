<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AuthAdminController;
use App\Http\Controllers\admin\UserAdminController;

use App\Http\Controllers\site\AuthController;
use App\Http\Controllers\site\UserController;
use App\Http\Controllers\site\SiteController;
use App\Http\Controllers\site\CompetitionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('admin.login');
})->name('root');

Route::prefix('painel')->group(function () {
    // Login routes
    Route::get('/', [AuthAdminController::class, 'showLoginPage'])->name('admin.login');
    Route::get('/login', [AuthAdminController::class, 'showLoginPage'])->name('admin.login');
    Route::post('/login', [AuthAdminController::class, 'login']);
    Route::get('/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');
    Route::get('/recuperar-senha', [AuthAdminController::class, 'showRequestPasswordPage'])->name('admin.recuperar-senha');
    Route::post('/recuperar-senha', [AuthAdminController::class, 'requestPassword']);
    Route::get('/password/reset', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::group(['middleware' => ['auth', 'check.user.type']], function () {
        Route::get('/cadastrar', [UserAdminController::class, 'showCreateUserPage'])->name('admin.cadastrar');
        Route::post('/cadastrar', [UserAdminController::class, 'createUserAdimin']);

        Route::get('/editar/{id}', [UserAdminController::class, 'showUpatedUserPage'])->name('admin.editar');
        Route::put('/admin/atualizar/{id}', [UserAdminController::class, 'updateUserAdmin'])->name('admin.atualizar');
        Route::delete('/deletar/{id}', [UserAdminController::class, 'deleteUserAdmin'])->name('admin.deletar');
    });
    Route::get('/listar-usuarios/busca', [UserAdminController::class, 'searchUsers'])->name('admin.painel.busca');
    Route::get('/listar-usuarios', [UserAdminController::class, 'listUsers'])->middleware('auth')->name('admin.painel');
});

Route::prefix('osu-bjj')->group(function () {
    Route::prefix('area-atleta')->group(function () {
        //auth user area routes
        Route::get('/', [AuthController::class, 'showLoginPage'])->name('site.area_atleta.login');
        Route::get('/login', [AuthController::class, 'showLoginPage'])->name('site.area_atleta.login');
        Route::get('/recuperar-senha', [AuthController::class, 'showRequestPasswordPage'])->name('site.area_atleta.recuperar_senha');
        Route::get('/esqueci-minha-senha', [AuthController::class, 'showForgotPasswordPage'])->name('site.area_atleta.esqueci_senha');
        Route::get('/esqueci-minha-senha/enviado', [AuthAdminController::class, 'showForgotPasswordEnvitePage'])->name('site.area_atleta.esqueci_senha_enviado');

        //restrict area routes
        Route::get('/incio', [UserController::class, 'showRestrictAreaPage'])->name('site.area_atleta.area_restrita');
        Route::get('/certificado-participacao', [CompetitionController::class, 'showCertificateParticipationPage'])->name('site.area_atleta.certificado_participacao');
        Route::get('/certificado-vitoria', [CompetitionController::class, 'showCertificateVictoryPage'])->name('site.area_atleta.certificado_vitoria');
    });

    //external site routes
    Route::get('/', [SiteController::class, 'showIndexPage'])->name('site.index');
    Route::get('/chave-integra', [SiteController::class, 'showKeyCompletPage'])->name('site.chave_integra');
    Route::get('/chave-listagem', [SiteController::class, 'showKeyListPage'])->name('site.chave_listagem');
    Route::get('/inscricao', [UserController::class, 'showSubscriptionPage'])->name('site.inscricao');
    Route::get('/resultados', [UserController::class, 'showResultPage'])->name('site.resultados');
    Route::get('/torneios', [SiteController::class, 'showTournamentPage'])->name('site.torneios');
});
