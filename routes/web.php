<?php

use App\Http\Controllers\CaixasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstoquesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MastersController;
use App\Http\Controllers\ServicosController;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\VendasController;
use App\Http\Middleware\Autenticador;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return to_route('dashboard.index');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('logando');
Route::get('/login/deslogar', [LoginController::class, 'destroy'])->name('deslogar');

Route::middleware(Autenticador::class)->group( function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/dashboard/filtro',[CaixasController::class, 'filter'])->name('dashboard.filter');

    Route::resource('/caixa', CaixasController::class);
    Route::post('/caixa/filtro',[CaixasController::class, 'filter'])->name('caixa.filter');

    Route::resource('/vendas', VendasController::class);
    Route::post('/vendas/filtro', [VendasController::class, 'filter'])->name('vendas.filter');
    Route::get('/vendas/{estoque}/buscarvalor', [VendasController::class, 'buscavalorestoque'])->name('vendas.buscavalor');

    Route::resource('/servicos', ServicosController::class);
    Route::post('/servicos/filtro', [ServicosController::class, 'filter'])->name('servicos.filter');

    Route::resource('/estoque', EstoquesController::class);
    Route::post('/estoque/filtro', [EstoquesController::class, 'filter'])->name('estoque.filter');

    Route::resource('/users', UsersController::class);

    Route::resource('/unidades', UnidadesController::class);

    Route::resource('/master', MastersController::class);
});


