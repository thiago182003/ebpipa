<?php

use App\Http\Controllers\EmpresaUserController;
use App\Http\Controllers\FaleConoscoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OperadorUserController;
use App\Http\Controllers\PipeiroUserController;
use Illuminate\Support\Facades\Route;

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
    return view('portal');
});

Route::get('/home', function () {
    return view('layouts.default');
});

Route::prefix('op')->middleware('operador')->group(function () {
    Route::post('logar', [OperadorUserController::class, 'logar'])->name('operador.logar')->withoutMiddleware('operador');
    Route::get('logout', [OperadorUserController::class, 'logout'])->name('operador.logout');
    Route::get('dashboard', [OperadorUserController::class, 'dashboard'])->name('operador.dashboard');
    Route::get('credenciamentos', [OperadorUserController::class, 'credenciamentos'])->name('operador.credenciamentos');
    Route::get('empresas', [OperadorUserController::class, 'empresas'])->name('operador.empresas');
    Route::get('pendentes', [OperadorUserController::class, 'pendentes'])->name('operador.pendentes');
    Route::get('cred/{id}', [OperadorUserController::class, 'cred'])->name('operador.cred');
    Route::get('aprovar/{id}', [OperadorUserController::class, 'aprovar'])->name('operador.aprovar');
    Route::get('cadastro', [OperadorUserController::class, 'cadastro'])->name('operador.cadastro');
    Route::post('cadastrar', [OperadorUserController::class, 'cadastrar'])->name('operador.cadastrar');
    Route::post('alterarsitarquivo', [OperadorUserController::class, 'alterarSitArquivo'])->name('operador.alterarsitarquivo');
    Route::get('faleconosco', [OperadorUserController::class, 'faleconosco'])->name('operador.faleconosco');
});

Route::prefix('empresa')->middleware('empresa')->group(function () {
    Route::get('logout', [EmpresaUserController::class, 'logout'])->name('empresa.logout');
    Route::get('dashboard', [EmpresaUserController::class, 'dashboard'])->name('empresa.dashboard');
    Route::get('credenciamento', [EmpresaUserController::class, 'credenciamento'])->name('empresa.credenciamento');
    Route::post('credenciar', [EmpresaUserController::class, 'credenciar'])->name('empresa.credenciar');
    Route::get('pendencias', [EmpresaUserController::class, 'pendencias'])->name('empresa.pendencias');
    Route::get('motoristas', [EmpresaUserController::class, 'motoristas'])->name('empresa.motoristas');
    Route::get('addmotorista', [EmpresaUserController::class, 'addmotorista'])->name('empresa.addmotorista');
    Route::get('addmotorista/{id}', [EmpresaUserController::class, 'addmotorista'])->name('empresa.editmotorista');
    Route::get('pendenciasmotorista/{id}', [EmpresaUserController::class, 'pendenciasmotorista'])->name('empresa.pendenciamotorista');
    Route::post('deletarArquivo', [EmpresaUserController::class, 'deletarArquivo'])->name('empresa.deletarArquivo');
    Route::post('salvarmotorista', [EmpresaUserController::class, 'salvarmotorista'])->name('empresa.salvarmotorista');
    Route::post('sanarpendenciasempresa', [EmpresaUserController::class, 'sanarpendenciasempresa'])->name('empresa.sanarpendenciasempresa');
    Route::post('sanarpendenciasmotorista', [EmpresaUserController::class, 'sanarpendenciasmotorista'])->name('empresa.sanarpendenciasmotorista');
});

Route::prefix('pipeiro')->middleware('pipeiro')->group(function () {
    Route::get('logout', [PipeiroUserController::class, 'logout'])->name('pipeiro.logout');
    Route::get('dashboard', [PipeiroUserController::class, 'dashboard'])->name('pipeiro.dashboard');
    Route::get('credenciamento', [PipeiroUserController::class, 'credenciamento'])->name('pipeiro.credenciamento');
    Route::post('credenciar', [PipeiroUserController::class, 'credenciar'])->name('pipeiro.credenciar');
    Route::get('pendencias', [PipeiroUserController::class, 'pendencias'])->name('pipeiro.pendencias');
    Route::post('deletarArquivo', [PipeiroUserController::class, 'deletarArquivo'])->name('credenciamento.deletarArquivo');
    Route::post('sanarpendencias', [PipeiroUserController::class, 'sanarpendencias'])->name('pipeiro.sanarpendencias');
    Route::get('redcredpdf', [PipeiroUserController::class, 'redcredpdf'])->name('pipeiro.redcredpdf');
});

Route::post('logar', [LoginController::class, 'logar'])->name('login.logar');
Route::get('op', [OperadorUserController::class, 'login'])->name('operador.login');
Route::get('login', [LoginController::class, 'login'])->name('login.login');
Route::post('cadastrar', [LoginController::class, 'cadastrar'])->name('login.cadastrar');
Route::get('cadastro', [LoginController::class, 'cadastro'])->name('login.cadastro');
Route::get('faleconosco', [FaleConoscoController::class, 'pagina'])->name('faleconosco.fale');
Route::post('enviarmensagem', [FaleConoscoController::class, 'enviar'])->name('faleconosco.enviar');
