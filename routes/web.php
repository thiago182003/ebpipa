<?php

use App\Http\Controllers\EmpresaUserController;
use App\Http\Controllers\FaleConoscoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OperadorUserController;
use App\Http\Controllers\PipeiroUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
})->name('portal');

Route::get('/atendimento-cliente', function () {
    return view('formsclientes');
})->name('portal.formsclientes');

Route::post('/enviar-contato', function () {
    // Aqui você pode implementar a lógica para processar o formulário
    // Por enquanto, vamos apenas redirecionar de volta com uma mensagem de sucesso
    return redirect()->back()->with('success', 'Mensagem enviada com sucesso!');
})->name('portal.enviar-contato');

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
    // Route::get('credemp/{id}', [OperadorUserController::class, 'cred'])->name('operador.credemp');
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

// Rota para criação segura de redirects para páginas internas permitidas
Route::get('login/redirect/{key}', function ($key, \Illuminate\Http\Request $request) {
    // Mapa de chaves permitidas -> URLs internas
    $map = [
        'atendimento' => route('portal.formsclientes'),
    ];

    if (!array_key_exists($key, $map)) {
        abort(404);
    }

    // Armazena URL de redirect segura na sessão e redireciona para a tela de login
    $request->session()->put('login_redirect', $map[$key]);
    return redirect()->route('login.login');
})->name('login.redirect');
Route::post('cadastrar', [LoginController::class, 'cadastrar'])->name('login.cadastrar');
Route::get('cadastro', [LoginController::class, 'cadastro'])->name('login.cadastro');
Route::get('faleconosco', [FaleConoscoController::class, 'pagina'])->name('faleconosco.fale');
Route::post('enviarmensagem', [FaleConoscoController::class, 'enviar'])->name('faleconosco.enviar');

// Rotas para Atendimento ao Cliente
Route::get('atendimento-cliente', function () {
    return view('formsclientes');
})->name('portal.formsclientes');

Route::post('salvar-atendimento', function (Illuminate\Http\Request $request) {
    // Validações base
    $request->validate([
        'estado' => 'required|string',
        'municipio' => 'required|string',
        'relato' => 'required|string',
        'anexos.*' => 'file|mimes:jpeg,jpg,png,pdf|max:5120' // 5MB por arquivo
    ]);

    $atendimento = new App\Models\Atendimento();
    
    $atendimento->usuario_autenticado = $request->usuario_autenticado === 'sim';
    $atendimento->user_type = $request->user_type;
    $atendimento->user_id = $request->user_id;
    $atendimento->user_name = $request->user_name;
    $atendimento->tipo_requerente = $request->tipo_requerente;
    $atendimento->outro_especificar = $request->outro_especificar;
    $atendimento->estado = $request->estado;
    $atendimento->municipio = $request->municipio;
    $atendimento->relato = $request->relato;
    
    $atendimento->save();

    // Processar anexos (opcional)
    if ($request->hasFile('anexos')) {
        foreach ($request->file('anexos') as $file) {
            if (!$file->isValid()) continue;

            // Armazenar de forma segura no disco público (configurar storage:link se necessário)
            $path = $file->store("atendimentos/{$atendimento->id}", 'public');

            $anexo = new App\Models\AtendimentoAnexo();
            $anexo->atendimento_id = $atendimento->id;
            $anexo->path = $path;
            $anexo->original_name = $file->getClientOriginalName();
            $anexo->mime = $file->getClientMimeType();
            $anexo->size = $file->getSize();
            $anexo->save();
        }
    }

    return redirect()->route('portal.formsclientes')->with('success', 'Sua solicitação foi enviada com sucesso! Em breve entraremos em contato.');
})->name('portal.salvar-atendimento');

// Rota AJAX para verificar CPF na tabela pipeiro_users
Route::post('portal/verificar-cpf', function (Illuminate\Http\Request $request) {
    $cpf = preg_replace('/\D/', '', $request->input('cpf'));

    if (!$cpf) {
        return response()->json(['message' => 'CPF inválido.'], 422);
    }

    if (strlen($cpf) !== 11) {
        return response()->json(['message' => 'CPF deve conter 11 dígitos.'], 422);
    }

    // Normaliza o campo cpf na tabela removendo '.', '-' e espaços antes de comparar
    $user = App\Models\Pipeiro_user::whereRaw("REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' ', '') = ?", [$cpf])->first();

    if ($user) {
        return response()->json(['found' => true, 'user' => [
            'id' => $user->id,
            'nome' => $user->nome,
            'cpf' => $user->cpf,
            'email' => $user->email,
        ]]);
    }

    return response()->json(['found' => false]);
})->name('portal.verificar-cpf');

// Rota para retornar municípios por sigla do estado (ex: PE, AL)
Route::get('portal/municipios/{sigla}', function ($sigla) {
    $sigla = strtoupper($sigla);
    $estado = App\Models\Estado::where('sigla', $sigla)->first();
    if (!$estado) {
        return response()->json(['municipios' => []]);
    }

    $municipios = $estado->municipios()->orderBy('nome')->get(['id','nome']);
    return response()->json(['municipios' => $municipios]);
})->name('portal.municipios');
