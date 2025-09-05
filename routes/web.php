<?php

use App\Http\Controllers\AnexoController;
use App\Http\Controllers\CredenciamentoController;
use App\Http\Controllers\DocumentacaoCandidatoController;
use App\Http\Controllers\DocumentacaoController;
use App\Http\Controllers\DocumentacaoEditalController;
use App\Http\Controllers\EditalController;
use App\Http\Controllers\EmpresaUserController;
use App\Http\Controllers\FaleConoscoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\OmController;
use App\Http\Controllers\OperadorUserController;
use App\Http\Controllers\PipeiroUserController;
use App\Models\DocumentacaoEdital;
use App\Models\Empresa_user;
use App\Models\Operador_user;
use App\Models\Pipeiro_user;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Constraint\Operator;

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

// Route::get('/', function () {
//     return view('portal');
// });
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
    Route::get('aprovarempresa/{id}', [OperadorUserController::class, 'aprovarempresa'])->name('operador.aprovarempresa');
    Route::get('aprovarmot/{id}', [OperadorUserController::class, 'aprovarmot'])->name('operador.aprovarmot');
    Route::get('cadastro', [OperadorUserController::class, 'cadastro'])->name('operador.cadastro');
    Route::post('cadastrar', [OperadorUserController::class, 'cadastrar'])->name('operador.cadastrar');
    Route::post('alterarsitarquivo', [OperadorUserController::class, 'alterarSitArquivo'])->name('operador.alterarsitarquivo');
    Route::get('om', [OmController::class, 'oms'])->name('om.oms');
    Route::get('om/novo', [OmController::class, 'novo'])->name('om.novo');
    Route::get('om/editar/{id}', [OmController::class, 'editar'])->name('om.editar');
    Route::post('om/salvar', [OmController::class, 'salvar'])->name('om.salvar');
    Route::post('om/deletar', [OmController::class, 'deletar'])->name('om.deletar');
    Route::get('operadores', [OperadorUserController::class, 'operadores'])->name('op.operadores');
    Route::get('novo', [OperadorUserController::class, 'novo'])->name('op.novo');
    Route::get('editar/{id}', [OperadorUserController::class, 'editar'])->name('op.editar');
    Route::post('salvar', [OperadorUserController::class, 'salvaroperador'])->name('op.salvar');
    Route::get('municipio', [MunicipioController::class, 'municipios'])->name('op.municipios');
    Route::get('municipio/novo', [MunicipioController::class, 'novo'])->name('municipio.novo');
    Route::get('municipio/editar/{id}', [MunicipioController::class, 'editar'])->name('municipio.editar');
    Route::post('municipio/salvar', [MunicipioController::class, 'salvar'])->name('municipio.salvar');
    Route::post('municipio/deletar', [MunicipioController::class, 'deletar'])->name('municipio.deletar');
    Route::get('editais', [EditalController::class, 'editais'])->name('op.editais');
    Route::get('edital/novo', [EditalController::class, 'novo'])->name('edital.novo');
    Route::get('edital/editar/{id}', [EditalController::class, 'editar'])->name('edital.editar');
    Route::post('edital/salvar', [EditalController::class, 'salvar'])->name('edital.salvar');
    Route::post('edital/deletar', [EditalController::class, 'deletar'])->name('edital.deletar');
    Route::post('edital/deletarArquivo', [EditalController::class, 'deletarArquivo'])->name('edital.deletarArquivo');
    Route::post('anexo/deletarArquivo', [AnexoController::class, 'deletarArquivo'])->name('anexo.deletarArquivo');
    Route::get('alterasenha', [OperadorUserController::class, 'alterasenha'])->name('op.alterasenha');
    Route::post('alterarsenha', [OperadorUserController::class, 'alterarsenha'])->name('op.alterarsenha');
    Route::post('deletar', [OperadorUserController::class, 'deletar'])->name('op.deletar');
    Route::post('resetarsenha', [CredenciamentoController::class, 'resetarsenha'])->name('credenciamento.resetarsenha');
    Route::post('descredenciar', [CredenciamentoController::class, 'descredenciar'])->name('credenciamento.descredenciar');
    Route::post('resetarsenhaop', [OperadorUserController::class, 'resetarsenha'])->name('op.resetarsenha');
    Route::get('anexos', [AnexoController::class, 'anexos'])->name('op.anexos');
    Route::post('anexos/salvar', [AnexoController::class, 'salvar'])->name('anexos.salvar');
    Route::post('baixararquivos', [OperadorUserController::class, 'baixararquivos'])->name('op.baixararquivos');
    Route::get('/download-arquivo/{fileName}', [OperadorUserController::class, 'downloadArquivo'])->name('op.downloadArquivo');
    Route::get('/relatorio/credenciamentos', [OperadorUserController::class, 'relatorioCredenciamento'])->name('relatorio.credenciamentos');
    Route::get('ouvidoria', [OperadorUserController::class, 'ouvidoria'])->name('operador.ouvidoria');
    Route::get('ouvidoria/download/{file}', [OperadorUserController::class, 'downloadAnexo'])->name('operador.ouvidoria.download');
    Route::post('ouvidoria/respond', [OperadorUserController::class, 'respond'])->name('operador.ouvidoria.respond');
    Route::get('/documentos', [DocumentacaoController::class, 'documentos'])->name('op.documentos');
    Route::get('/associardocumentos', [DocumentacaoController::class, 'associar'])->name('op.associardoc');
    Route::get('/documentos/novo', [DocumentacaoController::class, 'novo'])->name('documento.novo');
    Route::post('/documentos/salvar', [DocumentacaoController::class, 'salvar'])->name('documento.salvar');
    Route::get('/documentos/{id}', [DocumentacaoController::class, 'novo'])->name('documento.editar');
    Route::post('/documentos/buscaassociacao', [DocumentacaoEditalController::class, 'buscar'])->name('documento.buscaassociacao');
    Route::post('/deletardocumento', [DocumentacaoController::class, 'deletarDocumento'])->name('documento.deletarDocumento');
    Route::post('/deletararquivo', [DocumentacaoController::class, 'deletarArquivo'])->name('documento.deletarArquivo');
    Route::post('/salvarassocia', [DocumentacaoEditalController::class, 'salvar'])->name('documento.salvarassocia');
    Route::get('/buscapipeiro',[OperadorUserController::class,'buscapipeiro'])->name('operador.buscapipeiro');
    Route::post('/buscarpipeiro',[OperadorUserController::class,'buscarpipeiro'])->name('operador.buscarpipeiro');
    Route::get('/pipeiro/{id}/detalhes', [OperadorUserController::class, 'detalhesPipeiro'])->name('pipeiro.detalhes');
});

Route::prefix('empresa')->middleware('empresa')->group(function () {
    Route::get('credenciamentos', [EmpresaUserController::class, 'credenciamentos'])->name('empresa.credenciamentos');
    Route::get('logout', [EmpresaUserController::class, 'logout'])->name('empresa.logout');
    Route::get('dashboard', [EmpresaUserController::class, 'dashboard'])->name('empresa.dashboard');
    Route::get('credenciamento/novo', [EmpresaUserController::class, 'novocredenciamento'])->name('empresa.novocredenciamento');
    Route::get('credenciamento', [EmpresaUserController::class, 'credenciamento'])->name('empresa.credenciamento');
    Route::post('credenciar', [EmpresaUserController::class, 'credenciar'])->name('empresa.credenciar');
    Route::get('pendencias', [EmpresaUserController::class, 'pendencias'])->name('empresa.pendencias');
    Route::get('motoristas', [EmpresaUserController::class, 'motoristas'])->name('empresa.motoristas');
    Route::get('addmotorista', [EmpresaUserController::class, 'addmotorista'])->name('empresa.addmotorista');
    // Route::get('addmotorista/{pipeiro}/{credenciamento}', [EmpresaUserController::class, 'addmotorista'])->name('empresa.editmotorista');
    Route::get('pendenciasmotorista/{mot}/{cred}', [EmpresaUserController::class, 'pendenciasmotorista'])->name('empresa.pendenciamotorista');
    Route::post('deletarArquivo', [EmpresaUserController::class, 'deletarArquivo'])->name('empresa.deletarArquivo');
    Route::post('salvarmotorista', [EmpresaUserController::class, 'salvarmotorista'])->name('empresa.salvarmotorista');
    Route::post('sanarpendenciasempresa', [EmpresaUserController::class, 'sanarpendenciasempresa'])->name('empresa.sanarpendenciasempresa');
    Route::post('sanarpendenciasmotorista', [EmpresaUserController::class, 'sanarpendenciasmotorista'])->name('empresa.sanarpendenciasmotorista');
    Route::get('alterasenha', [EmpresaUserController::class, 'alterasenha'])->name('empresa.alterasenha');
    Route::post('alterarsenha', [EmpresaUserController::class, 'alterarsenha'])->name('empresa.alterarsenha');
    Route::post('enviarcredenciamento', [CredenciamentoController::class, 'enviarCredenciamentoEmpresa'])->name('empresa.enviarCredenciamento');
    Route::post('enviarmotorista', [CredenciamentoController::class, 'enviarCredenciamentoMotorista'])->name('empresa.enviarmotorista');
    Route::post('deletarcredenciamentoempresa', [CredenciamentoController::class, 'deletarCredenciamentoEmpresa'])->name('credenciamento.deletarcredenciamentoemp');
    Route::post('carregarmunicipios', [EmpresaUserController::class, 'carregarmunicipios'])->name('empresa.carregarmunicipios');
    Route::post('pesquisaCPF', [EmpresaUserController::class, 'pesquisaCPF'])->name('empresa.pesquisaCPF');
});

Route::prefix('pipeiro')->middleware('pipeiro')->group(function () {
    Route::get('logout', [PipeiroUserController::class, 'logout'])->name('pipeiro.logout');
    Route::get('dashboard', [PipeiroUserController::class, 'dashboard'])->name('pipeiro.dashboard');
    Route::get('credenciamento', [PipeiroUserController::class, 'gerenciarCredenciamento'])->name('pipeiro.credenciamento');
    Route::post('credenciar', [PipeiroUserController::class, 'credenciar'])->name('pipeiro.credenciar');
    Route::get('pendencias', [PipeiroUserController::class, 'pendencias'])->name('pipeiro.pendencias');
    Route::post('deletarArquivo',  [CredenciamentoController::class, 'deletarArquivo'])->name('credenciamento.deletarArquivo');
    Route::post('sanarpendencias', [PipeiroUserController::class, 'sanarpendencias'])->name('pipeiro.sanarpendencias');
    Route::get('redcredpdf', [PipeiroUserController::class, 'redcredpdf'])->name('pipeiro.redcredpdf');
    Route::get('credenciamentos', [PipeiroUserController::class, 'credenciamentos'])->name('pipeiro.credenciamentos');
    Route::get('credenciamento/novo', [PipeiroUserController::class, 'gerenciarCredenciamento'])->name('pipeiro.novocredenciamento');
    Route::get('credenciamento/{id}', [PipeiroUserController::class, 'gerenciarCredenciamento'])->name('pipeiro.editarcredenciamento');
    Route::get('alterasenha', [PipeiroUserController::class, 'alterasenha'])->name('pipeiro.alterasenha');
    Route::post('alterarsenha', [PipeiroUserController::class, 'alterarsenha'])->name('pipeiro.alterarsenha');
    Route::post('enviarcredenciamento', [CredenciamentoController::class, 'enviarCredenciamento'])->name('pipeiro.enviarCredenciamento');
    Route::post('deletarcredenciamento', [CredenciamentoController::class, 'deletarCredenciamento'])->name('credenciamento.deletarcredenciamento');
    Route::post('carregarmunicipios', [PipeiroUserController::class, 'carregarmunicipios'])->name('pipeiro.carregarmunicipios');
});


Route::get('documentacoes', [DocumentacaoCandidatoController::class, 'documentacoes'])->name('documentacoes.extra');
Route::post('documentacoesbuscar', [DocumentacaoCandidatoController::class, 'buscar'])->name('documentacoes.buscar');
Route::post('documentacoessalvar', [DocumentacaoCandidatoController::class, 'salvar'])->name('documentacoes.salvar');
Route::get('op', [OperadorUserController::class, 'login'])->name('operador.login');
Route::post('logar', [LoginController::class, 'logar'])->name('login.logar');
Route::get('login', [LoginController::class, 'login'])->name('login.login');
Route::post('cadastrar', [LoginController::class, 'cadastrar'])->name('login.cadastrar');
Route::get('cadastro', [LoginController::class, 'cadastro'])->name('login.cadastro');
Route::post('enviarmensagem', [FaleConoscoController::class, 'enviar'])->name('faleconosco.enviar');

// Formulário público de reclamação/informação
use App\Http\Controllers\FormController;
Route::get('forms', [FormController::class, 'show'])->name('forms.show');
Route::post('forms/check-cpf', [FormController::class, 'checkCpf'])->name('forms.checkCpf');
Route::get('forms/estados', [FormController::class, 'estados'])->name('forms.estados');
Route::get('forms/municipios/{id}', [FormController::class, 'municipios'])->name('forms.municipios');
Route::post('forms/submit', [FormController::class, 'submit'])->name('forms.submit');
