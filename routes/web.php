<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AuthAdminController;
use App\Http\Controllers\admin\UserAdminController;

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

Route::prefix('painel')->group(function () {
    //login routes
    Route::get('/', [AuthAdminController::class, 'showLoginPage'])->name('admin.login');
    Route::get('/login', [AuthAdminController::class, 'showLoginPage'])->name('admin.login');
    Route::post('/login', [AuthAdminController::class, 'login']);
    Route::get('/recuperar-senha', [AuthAdminController::class, 'showRequestPasswordPage'])->name('admin.recuperar-senha');
    Route::post('/recuperar-senha', [AuthAdminController::class, 'requestPassword']);

    //User routes
    Route::get('/cadastrar', [UserAdminController::class, 'showCreateUserPage'])->name('admin.cadastrar');
    Route::get('/editar', [UserAdminController::class, 'showUpatedUserPage'])->name('admin.editar');

    //Painel routes
    Route::get('/admin', [AdminController::class, 'showPainelPage'])->name('admin.painel');
});


//Route::get('/', [AdminController::class, 'login']);
// Route::match(['get', 'post'], '/painel', function () {
//     Route::get('/', [AdminController::class, 'login']);
// });

// // // Rotas para a parte admin
// Route::group(['prefix' => 'admin', 'as' => 'admin'], function () {
//     Route::get('/', [AdminController::class, 'login']);
// });

// // Rotas para o site
// Route::group(['prefix' => 'site'], function () {
//     // Suas rotas aqui
// });


// // Rotas para o backend
// Route::group(['prefix' => 'backend'], function () {
//     // Suas rotas aqui
// });
