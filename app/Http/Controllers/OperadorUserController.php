<?php

namespace App\Http\Controllers;

use App\Models\credenciamento;
use App\Models\dadosbancarios;
use App\Models\DocumentacaoCandidato;
use App\Models\DocumentacaoEdital;
use App\Models\Edital;
use App\Models\Empresa_user;
use App\Models\endereco;
use App\Models\Estado;
use App\Models\faleConosco;
use App\Models\Municipio;
use App\Models\Om;
use App\Models\Operador_user;
use App\Models\Pg;
use App\Models\Pipeiro_user;
use App\Models\veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use ZipArchive;
use Carbon\Carbon;

class OperadorUserController extends Controller
{
    public function login()
    {
        return view('operador.login');
    }

    public function logar(Request $request)
    {
        $request->validate([
            'cpf' => ['required'],
            'password' => ['required']
        ], [
            'cpf.required'
        ]);
        // Normalizar e tentar CPF com/sem pontuação para evitar falha por formato
        $cpfInput = $request->input('cpf');
        if (!LoginController::validarcpf($cpfInput)) {
            return back()->withErrors([
                'error' => 'Cpf Inválido.'
            ])->onlyInput('cpf');
        }

        $cpfDigits = preg_replace('/\D/', '', $cpfInput);

        // Tentar localizar o usuário usando a forma armazenada no DB (com ou sem pontuação)
        $user = Operador_user::where('cpf', $cpfInput)
            ->orWhere('cpf', $cpfDigits)
            ->first();

        $password = $request->input('password');
        $log = false;

        if ($user) {
            // usar exatamente o valor salvo no banco para o attempt
            $credentials = ['cpf' => $user->cpf, 'password' => $password];
            $log = Auth::guard('operador')->attempt($credentials, false);
        } else {
            // fallback: tentar com entrada original e com apenas dígitos
            $credentials = ['cpf' => $cpfInput, 'password' => $password];
            $log = Auth::guard('operador')->attempt($credentials, false);
            if (!$log && $cpfDigits !== $cpfInput) {
                $credentials = ['cpf' => $cpfDigits, 'password' => $password];
                $log = Auth::guard('operador')->attempt($credentials, false);
            }
        }
        if ($log) {
            $request->session()->regenerate();
            return redirect()->route('operador.dashboard');
        }
        return back()->withErrors([
            'error' => 'Cpf ou Senha Incorreto.'
        ])->onlyInput('cpf');
    }

    public static function contarStatus($qtdArray)
    {
        $statusCount = [
            'aprovados' => 0,
            'correcao' => 0,
            'analise' => 0,
            'corrigido' => 0,
            'aguardando' => 0,
            'iniciados' => 0,
        ];

        foreach ($qtdArray as $q) {
            switch ($q['status']) {
                case 1:
                    $statusCount['aprovados'] += $q['qtd'];
                    break;
                case 2:
                    $statusCount['correcao'] += $q['qtd'];
                    break;
                case 3:
                    $statusCount['analise'] += $q['qtd'];
                    break;
                case 4:
                    $statusCount['corrigido'] += $q['qtd'];
                    break;
                case 98:
                    $statusCount['aguardando'] += $q['qtd'];
                    break;
                case 99:
                    $statusCount['iniciados'] += $q['qtd'];
                    break;
            }
        }
        return $statusCount;
    }

    public function dashboard()
    {
        $fisica = self::contarStatus(CredenciamentoController::quantidadeFisica());
        $juridica = self::contarStatus(CredenciamentoController::quantidadeJuridica());
        $motoristas = self::contarStatus(CredenciamentoController::quantidadeMotoristas());
        foreach ($motoristas as $key => $value) {
            $juridica[$key] += $value;
        }
        
        return view('operador.dashboard',compact('fisica','juridica'));
    }

    public function logout(Request $request)
    {
        Auth::guard('operador')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('operador.login');
    }

    public function cadastro()
    {
        return view('operador.cadastro');
    }

    public function cadastrar(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        dd($data);
        Operador_user::create($data);

        return redirect()->route('operador.login');
    }

    public function perfil()
    {

        $operador = auth('operador')->user();
        return view('operador.perfil', ['operador' => $operador]);
    }

    public function salvar(Request $request)
    {

        $pip = Operador_user::find($request->id);
        $pip->fill($request->all());
        $pip->update();
        // dd($pip);
    }

    public function credenciamentos()
    {
        $editais = EditalController::editaisAbertos();
        // dd($editais);
        $creds = credenciamento::with("pipeiro")->wherein('id_edital',$editais)->where('status', '!=', "99")->whereNotNull("id_pipeiro")->whereNull('id_empresa')->get();
        $credsAnalise = $creds->where('status', 3);
        $credsCorrigidos = $creds->where('status', 4);
        $credsCorrecao = $creds->where('status', 2);
        $credsAprovados = $creds->where('status', 1);

        return view('operador.credenciamentos',compact('credsAnalise', 'credsCorrigidos', 'credsCorrecao', 'credsAprovados'));
    }

    public function pendentes()
    {

        $creds = credenciamento::where('status', "99")->get();
        $pipeiros = Pipeiro_user::with('credenciamentos')->whereDoesntHave('credenciamentos')->get();
        $empresas= Empresa_user::with('credenciamentos')->whereDoesntHave('credenciamentos')->orderBy('id')->orderBy('razaosocial')->get();
        
        foreach ($creds as $cred) {
            if (!is_null($cred->id_pipeiro)) {
                $cred->pipeiro = Pipeiro_user::find($cred->id_pipeiro);
            } elseif (!is_null($cred->id_empresa)) {
                $cred->empresa = Empresa_user::find($cred->id_empresa);
            }
        }
        return view('operador.pendentes',compact('creds','pipeiros','empresas'));
    }

    public function faleconosco()
    {
        $faleconosco = faleConosco::all();
        return redirect()->route("operador.faleconosco", compact('faleconosco'));
    }

    public function empresas()
    {
        $empresas = Credenciamento::with('pipeiro')->with('empresa')->where('status', '!=', "99")
        ->whereNotNull('id_empresa')
        ->get();
        $operador = Auth::guard('operador')->user();
        $empresas = Credenciamento::with(['pipeiro', 'empresa'])
            ->where('status', '!=', '99')
            ->whereNotNull('id_empresa')
            ->whereHas('edital', function ($query) use ($operador) {
                $query->where('id_om', $operador->id_om);
            })
            ->get();
        
        $credsAnalise = $empresas->where('status', 3);
        $credsCorrigidos = $empresas->where('status', 4);
        $credsCorrecao = $empresas->where('status', 2);
        $credsAprovados = $empresas->where('status', 1);

        return view('operador.empresas', compact('credsAnalise', 'credsCorrigidos', 'credsCorrecao', 'credsAprovados'));
    }

    public function ouvidoria()
    {
        $dir = storage_path('app/public/forms');
        $items = [];
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $f) {
                if (in_array($f, ['.', '..'])) continue;
                if (pathinfo($f, PATHINFO_EXTENSION) !== 'json') continue;
                $content = @file_get_contents($dir . '/' . $f);
                $data = json_decode($content, true);
                if ($data) {
                    $data['_filename'] = $f;
                    // resolver nomes de estado/municipio quando ids foram salvos
                    if (!empty($data['estado'])) {
                        try { $e = Estado::find($data['estado']); $data['estado_nome'] = $e ? $e->nome : $data['estado']; } catch(\Throwable $ex){ $data['estado_nome'] = $data['estado']; }
                    } else { $data['estado_nome'] = '-'; }
                    if (!empty($data['municipio'])) {
                        try { $m = Municipio::find($data['municipio']); $data['municipio_nome'] = $m ? $m->nome : $data['municipio']; } catch(\Throwable $ex){ $data['municipio_nome'] = $data['municipio']; }
                    } else { $data['municipio_nome'] = '-'; }
                    // se tipo_requerente não estiver presente, tentar inferir a partir do CPF (se existente no pipeiro_users)
                    if (empty($data['tipo_requerente']) && !empty($data['cpf'])) {
                        try {
                            $cpfDigits = preg_replace('/\D/', '', $data['cpf']);
                            $found = Pipeiro_user::whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' ', ''), '/', '') = ?", [$cpfDigits])->first();
                            if ($found) {
                                $data['tipo_requerente'] = 'PIPEIRO';
                            }
                        } catch (\Throwable $ex) {
                            // silencioso
                        }
                    }
                    // formatar created_at para formato brasileiro d/m/Y se disponível
                    if (!empty($data['created_at'])) {
                        try {
                            $dt = \Carbon\Carbon::parse($data['created_at']);
                            $data['created_at_br'] = $dt->format('d/m/Y');
                        } catch (\Throwable $ex) {
                            $data['created_at_br'] = $data['created_at'];
                        }
                    } else {
                        $data['created_at_br'] = '-';
                    }

                    $items[] = $data;
                }
            }
        }
        // ordenar por created_at desc
        usort($items, function($a,$b){ return strcmp($b['created_at'] ?? '', $a['created_at'] ?? ''); });
        return view('operador.ouvidoria', compact('items'));
    }

    public function downloadAnexo($file)
    {
        $path = storage_path('app/public/forms/' . $file);
        if (!file_exists($path)) {
            abort(404);
        }
        return response()->download($path);
    }

    public function respond(Request $request)
    {
        $request->validate([
            'protocolo' => 'required|string',
            'resposta' => 'required|string',
            'anexos.*' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:5120'
        ]);

        $protocol = $request->input('protocolo');
        $dir = storage_path('app/public/forms/responses');
        if (!file_exists($dir)) mkdir($dir, 0755, true);

        $saved = [];
        if ($request->hasFile('anexos')){
            foreach($request->file('anexos') as $f){
                if($f->isValid()){
                    $name = time().'_'.preg_replace('/[^A-Za-z0-9\.\-_]/','_', $f->getClientOriginalName());
                    $f->move($dir, $name);
                    $saved[] = asset('storage/forms/responses/'.$name);
                }
            }
        }

        // gravar arquivo de resposta simples em storage
        $respFile = $dir.'/resp_'.$protocol.'_'.time().'.json';
        $payload = [
            'protocolo' => $protocol,
            'resposta' => $request->input('resposta'),
            'anexos' => $saved,
            'respondido_por' => Auth::guard('operador')->user()->nomeguerra ?? Auth::guard('operador')->user()->nome ?? 'operador',
            'created_at' => now()->toDateTimeString()
        ];
        file_put_contents($respFile, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('operador.ouvidoria')->with('success','Resposta registrada com sucesso.');
    }

    public function cred($cred)
    {
        $credenciamento = credenciamento::with('logs', 'edital')->find($cred);
        // Log para depuração: quem tentou acessar e qual credenciamento foi buscado
        try {
            $oper = Auth::guard('operador')->user();
            Log::info('OperadorUserController@cred accessed', [
                'requested_cred' => $cred,
                'found_cred' => $credenciamento ? $credenciamento->id : null,
                'operador_id' => $oper ? $oper->id : null,
                'operador_nivel' => $oper ? $oper->nivel : null,
                'operador_om' => $oper ? $oper->id_om : null,
                'edital_om' => ($credenciamento && $credenciamento->edital) ? $credenciamento->edital->id_om : null,
            ]);
        } catch (\Throwable $e) {
            // não falhar em produção por causa do log
        }
        if (!$credenciamento) {
            return redirect()->route('operador.credenciamentos')->with('error', 'Credenciamento não encontrado.');
        }
        
        // dd($credenciamento);
        // Verifica se a OM do edital é igual à OM do operador logado
        $operador = Auth::guard('operador')->user();
        // operadores nível 0 têm acesso a todos os editais
        if ($operador->nivel != 0 && $credenciamento->edital->id_om !== $operador->id_om) {
            return redirect()->route('operador.credenciamentos')->with('error', 'Você não tem permissão para acessar este credenciamento.');
        }
        // $credenciamento = credenciamento::with('logs')->find($cred);
        $documentosEdital =  DocumentacaoEdital::where('edital_id',$credenciamento->id_edital)->get();
        
        // dd($documentosEdital);ta 
        $edital = Edital::find($credenciamento->id_edital);
        $estado = Estado::find($credenciamento->id_estado);
        $municipio = Municipio::find($credenciamento->id_municipio);
        $endereco = endereco::where("id_credenciamento",$credenciamento->id)->first();
        $endereco->estado = Estado::find($endereco->estado);
        $veiculo = veiculo::where("id_credenciamento",$credenciamento->id)->first();
        $dadosbancarios = dadosbancarios::with('dadosbanco')->where("id_credenciamento",$credenciamento->id)->first();
        //é motorista
        if(!is_null($credenciamento->id_pipeiro) && !is_null($credenciamento->id_empresa)){
            $empresa = Empresa_user::find($credenciamento->id_empresa);
            $pipeiro = Pipeiro_user::find($credenciamento->id_pipeiro);
            $pipeiro->escolaridade = $this->getEscolaridade($pipeiro->escolaridade);
            $pipeiro->estadocivil = $this->getEstadoCivil($pipeiro->estadocivil);
            $pipeiro->raca = $this->getRaca($pipeiro->raca);
            foreach($documentosEdital as $doc){
                $documentosEdital["doc_candidato"] = DocumentacaoCandidato::where('candidato_id',$pipeiro->id)->where('candidato_type','pipeiro')->where('edital_id',$edital->id)->where('documentacao_id',$doc->id)->first();
            }
            return view("operador.credmot", compact('credenciamento', 'veiculo', 'pipeiro', 'edital', 'dadosbancarios', 'estado', 'municipio', 'endereco','documentosEdital'));
        //é pipeiro
        }else if(!is_null($credenciamento->id_pipeiro)){
            $pipeiro = Pipeiro_user::find($credenciamento->id_pipeiro);
            $pipeiro->escolaridade = $this->getEscolaridade($pipeiro->escolaridade);
            $pipeiro->estadocivil = $this->getEstadoCivil($pipeiro->estadocivil);
            $pipeiro->raca = $this->getRaca($pipeiro->raca);
            foreach($documentosEdital as $doc){
                // $documentosEdital["doc_candidato"] = DocumentacaoCandidato::all();
                $doc["doc_candidato"] = DocumentacaoCandidato::where('candidato_id',$pipeiro->id)->where('candidato_type','pipeiro')->where('edital_id',$edital->id)->where('documentacao_id',$doc->documentacao_id)->first();
            }
            // dd($pipeiro->id,$edital->id,$doc->documentacao_id,$documentosEdital);
            return view("operador.cred", compact('credenciamento', 'veiculo', 'pipeiro', 'edital', 'dadosbancarios', 'estado', 'municipio', 'endereco','documentosEdital'));
        //empresa
        }else{
            $empresa = Empresa_user::find($credenciamento->id_empresa);
            $motoristas = Pipeiro_user::where("id_empresa", $empresa->id)->get();
            foreach ($motoristas as $mot) {
                $mot["credenciamento"] = credenciamento::where('id_pipeiro', $mot->id)->first();
            }
            // dd($motoristas);
            foreach($documentosEdital as $doc){
                $documentosEdital["doc_candidato"] = DocumentacaoCandidato::where('candidato_id',$empresa->id)->where('candidato_type','empresa')->where('edital_id',$edital->id)->where('documentacao_id',$doc->id)->first();
            }
            return view("operador.credemp", compact('credenciamento', 'veiculo', 'empresa', 'edital', 'dadosbancarios', 'estado', 'municipio', 'endereco', 'motoristas','documentosEdital'));
        }

    }

    public function aprovar($cred)
    {
        $credenciamento = credenciamento::find($cred);
        
        //verificar se tem pendencias;
        $pendencias = CredenciamentoController::AnalisarArquivos($credenciamento->id_pipeiro,$credenciamento->id);
        // dd($pendencias);
        if (count($pendencias) > 0) {
            $mensagem = "Não aprovado pois ainda existe documentos para ser analisados.";
        } else if (count($pendencias) == 0) {
            $credenciamento->status = 1;
            $mensagem = "Aprovado com sucesso.";
        }

        $editais = EditalController::editaisAbertos();
        // dd($editais);
        $creds = credenciamento::wherein('id_edital',$editais)->where('status', '!=', "99")->whereNotNull("id_pipeiro")->whereNull('id_empresa')->get();
        // dd($creds);
        foreach ($creds as $cred) {
            $cred->pipeiro = Pipeiro_user::find($cred->id_pipeiro);
        }
        $credenciamento->save();
        return redirect()->route('operador.credenciamentos',compact('creds'))->with('success', $mensagem);
    }

    public function aprovarempresa($cred)
    {
        $credenciamento = credenciamento::find($cred);
        
        //verificar se tem pendencias;
        $pendencias = CredenciamentoController::AnalisarArquivosEmpresa($credenciamento->id_pipeiro,$credenciamento->id);
        // dd($pendencias);
        if (count($pendencias) > 0) {
            $mensagem = "Não aprovado pois ainda existe documentos para ser analisados.";
        } else if (count($pendencias) == 0) {
            $credenciamento->status = 1;
            $mensagem = "Aprovado com sucesso.";
        }

        $editais = EditalController::editaisAbertos();
        // dd($editais);
        $creds = credenciamento::wherein('id_edital',$editais)->where('status', '!=', "99")->whereNotNull("id_pipeiro")->whereNull('id_empresa')->get();
        // dd($creds);
        foreach ($creds as $cred) {
            $cred->pipeiro = Pipeiro_user::find($cred->id_pipeiro);
        }
        $credenciamento->save();
        return redirect()->route('operador.empresas',compact('creds'))->with('success', $mensagem);
    }

    public function aprovarmot($cred)
    {
        $credenciamento = credenciamento::find($cred);
        $credempresa = credenciamento::where(['id_empresa'=>$credenciamento->id_empresa,'id_edital'=>$credenciamento->id_edital,'id_pipeiro'=>null])->first();
        $empresa = Empresa_user::find($credenciamento->id_empresa);
        // dd($credempresa);
        if($credempresa->status !=1){
            $mensagem = "Não aprovado, pois primeiro a empresa precisa ser aprovada.";
        }else{
            //verificar se tem pendencias;
            $pendencias = CredenciamentoController::AnalisarArquivosMot($credenciamento->id_pipeiro,$credenciamento->id);
            // dd($pendencias);
            if (count($pendencias) > 0) {
                $mensagem = "Não aprovado pois ainda existe documentos para ser analisados.";
            } else if (count($pendencias) == 0) {
                $credenciamento->status = 1;
                $mensagem = "Aprovado com sucesso.";
            }
        }
        
        $editais = EditalController::editaisAbertos();
        // dd($editais);
        $creds = credenciamento::wherein('id_edital',$editais)->where('status', '!=', "99")->whereNotNull("id_pipeiro")->whereNull('id_empresa')->get();
        // dd($creds);
        foreach ($creds as $cred) {
            $cred->pipeiro = Pipeiro_user::find($cred->id_pipeiro);
        }
        $credenciamento->save();
        return redirect()->route('operador.empresas',compact('creds'))->with('success', $mensagem);
    }

    public function alterarSitArquivo(Request $request)
    {

        $credenciamento = credenciamento::find($request->credenciamento);
        switch ($request->tipo) {
            case "credenciamento":
                $class = credenciamento::find($request->id);
                break;
            case "endereco":
                $class = endereco::find($request->id);
                break;
            case "dadosbancarios":
                $class = dadosbancarios::find($request->id);
                break;
            case "pipeiro":
                $class = Pipeiro_user::find($request->id);
                break;
            case "veiculo":
                $class = veiculo::find($request->id);
                break;
            case "empresa":
                $class = Empresa_user::find($request->id);
                break;
        }
        // dd($class,$credenciamento);
        if($request->tipo != "credenciamento"){
            $class["$request->arquivo" . "_status"] = $request->status;
            if ($request->status == '99') {
                $credenciamento->status = 2;
            }
            $credenciamento->save();
            $class["$request->arquivo" . "_obs"] = $request->obs ? $request->obs : "";
            $class->save();
        }else{
            $credenciamento["$request->arquivo" . "_status"] = $request->status;
            if ($request->status == '99') {
                $credenciamento->status = 2;
            }
            $credenciamento["$request->arquivo" . "_obs"] = $request->obs ? $request->obs : "";
            $credenciamento->save();
        }
    }

    public function operadores()
    {
        //pegar quem ta logado, verificar o nivel e pesquisar operadores pela OM
        $nivel = Auth::guard('operador')->user()->nivel;
        if($nivel == 0){
            $operadores = Operador_user::all();
        }else{
            $operadores = Operador_user::where('id_om',Auth::guard('operador')->user()->id_om)->get();
        }
        
        foreach ($operadores as $op) {
            $op->om = Om::find($op->id_om);
        }
        return view("operador.operadores",compact('operadores'));
    }

    public function novo()
    {
        $oms = OmController::buscarOms();   
        $pgs = Pg::all();
        return view("operador.novo",compact('oms','pgs'));
    }

    public function editar(Request $request)
    {
        $op = Operador_user::find($request->id);
        $oms = OmController::buscarOms();
        $pgs = Pg::all();
        // dd($request->id,$om,$operadores);
        return view("operador.novo",compact('op','oms','pgs'));
    }

    public function salvarOperador(Request $request)
    {
        $operador = Operador_user::firstOrNew(['id' => $request->id]);
        $operador->fill($request->all());

        // Garantir que o campo email não seja nulo (DB exige NOT NULL)
        // Se não veio email no request, gerar um fallback a partir do CPF sem pontuação
        if (empty($operador->email)) {
            $cpf = $operador->cpf ?? $request->cpf ?? null;
            $cpfClean = $cpf ? preg_replace('/\D/', '', $cpf) : null;
            $operador->email = $cpfClean ? $cpfClean . '@noemail.local' : 'operador_' . time() . '@noemail.local';
        }

        if (is_null($operador->password) || $operador->password === ''){
            $senha = str_replace(".","",$operador->cpf);
            $senha = str_replace("-","",$senha);    
            $operador->password = bcrypt($senha);
            // $operador->mudasenha = 1;
        }
        $operador->save();
        // dd($operador);
        $operadores = Operador_user::all(); 
        foreach ($operadores as $op) {
            $op->om = Om::find($op->id_om);
        }
        return redirect()->route("op.operadores",compact('operadores'));
    }

    public function deletar(Request $request){
        $id = $request->id;
        $op = Operador_user::find($id);
        $op->delete();
    }

    public function resetarsenha(Request $request){
            $op = Operador_user::find($request->id);
            $doc = $op->cpf;
            $doc = str_replace(array('.','-'),'',$doc);
            $op->password = bcrypt($doc);
            // $op->mudarsenha = 1;
            // dd($op,$doc);
            $op->save();

    }

    public function alterasenha(){
        return view('operador.alterarsenha');
    }

    public function alterarsenha(Request $request){
        if($request->novasenha != $request->senhaconfirma){
            return back()->with('error', 'Confirme a senha corretamente');
        }

        // dd($request->senhaantiga, Auth::guard('operador')->user()->password);
        // Verifica se a senha atual está correta
        if (!Hash::check($request->senhaantiga, Auth::guard('operador')->user()->password)) {
            return back()->with('error', 'A senha atual está incorreta');
        }

        $user = Operador_user::find(Auth::guard('operador')->user()->id);
        $user->password = bcrypt($request->novasenha);
        $user->save();
    
        return redirect()->route('op.alterasenha')->with('status', 'Senha alterada com sucesso!');
    }

    public function baixararquivos(Request $request) {
        $id = $request->id;
        $edital = $request->edital;
        $id_credenciamento = $request->credenciamento;
        $credenciamento = credenciamento::find($id_credenciamento);
    
        // Arquivos a serem adicionados ao ZIP
        $files = [
            storage_path('app/public/' . $credenciamento->endereco->comprovanteresidencia) => '1.pdf',
            storage_path('app/public/' . $credenciamento->pipeiro->cnhfrente) => '2.pdf',
            storage_path('app/public/' . $credenciamento->veiculo->doc_crlv) => '3.pdf',
            storage_path('app/public/' . $credenciamento->veiculo->doc_lav) => '4.pdf',
            storage_path('app/public/' . $credenciamento->veiculo->veiculo_img) => '5.pdf',
            storage_path('app/public/' . $credenciamento->dadosbancarios->doc_comprovante) => '6.pdf',
            storage_path('app/public/' . $credenciamento->doc_reqcred) => '7.pdf',
            storage_path('app/public/' . $credenciamento->doc_cico) => '8.pdf',
            storage_path('app/public/' . $credenciamento->doc_drctvc) => '9.pdf',
            storage_path('app/public/' . $credenciamento->doc_maed) => '10.pdf',
            storage_path('app/public/' . $credenciamento->doc_cicips) => '11.pdf',
            storage_path('app/public/' . $credenciamento->doc_cqe) => '12.pdf',
            storage_path('app/public/' . $credenciamento->doc_cqsm) => '13.pdf',
            storage_path('app/public/' . $credenciamento->doc_sicaf) => '14.pdf',
            storage_path('app/public/' . $credenciamento->doc_ciscc) => '15.pdf',
            storage_path('app/public/' . $credenciamento->doc_cndf) => '16.pdf',
            storage_path('app/public/' . $credenciamento->doc_cnde) => '17.pdf',
            storage_path('app/public/' . $credenciamento->doc_cndm) => '18.pdf',
            storage_path('app/public/' . $credenciamento->doc_cidt) => '19.pdf',
            storage_path('app/public/' . $credenciamento->doc_antt) => '20.pdf',
            storage_path('app/public/' . $credenciamento->doc_lvs) => '21.pdf',
            storage_path('app/public/' . $credenciamento->veiculo->doc_cl) => '22.pdf',
            storage_path('app/public/' . $credenciamento->doc_act) => '23.pdf',
        ];
    
        // Caminho da pasta temporária
        $tempFolder = storage_path('app/public/temp');
        if (!is_dir($tempFolder)) {
            mkdir($tempFolder, 0755, true);
        }
        
        // Nome do arquivo ZIP e caminho completo
        $zipFileName = $credenciamento->pipeiro->cpf . ".zip";
        $zipFilePath = $tempFolder . '/' . $zipFileName;
    
        // Cria o arquivo ZIP
        $zip = new \ZipArchive;
        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            foreach ($files as $originalFilePath => $newFileName) {
                if (is_file($originalFilePath)) {
                    $zip->addFile($originalFilePath, $newFileName);
                } else {
                    continue;
                    // return response()->json(['error' => "Arquivo não encontrado: $originalFilePath"], 404);
                }
            }
            $zip->close();
        } else {
            return response()->json(['error' => 'Não foi possível criar o arquivo ZIP'], 500);
        }
    
        // Verifica se o arquivo ZIP foi realmente criado
        if (!file_exists($zipFilePath)) {
            return response()->json(['error' => 'O arquivo ZIP não foi criado'], 500);
        }
        // dd($tempFolder,asset('app/temp/' . $zipFileName));
        // Retorna o arquivo ZIP para download e remove-o após o envio
        return response()->json([
            'downloadUrl' => route('op.downloadArquivo', ['fileName' => $zipFileName])
        ]);
        // return response()->json(['zipFilePath' => asset('storage/temp/' . $zipFileName),
        //                         "arquivonome"=>$zipFileName]);
    }

    public function downloadArquivo($fileName)
    {
        $filePath = storage_path("app/public/temp/$fileName");

        if (!file_exists($filePath)) {
            abort(404, 'Arquivo não encontrado');
        }

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function relatorioCredenciamento(){
        $editais = EditalController::editaisAbertosOM();
        // $creds = credenciamento::with("pipeiro")->with("empresa")->wherein('id_edital',$editais)->where('status', '!=', "99")->get();
        $creds = credenciamento::with(["pipeiro","empresa","municipio",'veiculo'])->wherein('id_edital',$editais)->where('status', '!=', "99")->get();
        foreach($creds as $c){
            $c->status = CredenciamentoController::credStatus($c->status);
        }
        return view('relatorios.credenciamentos',compact('creds'));
    }

    // public function baixararquivos(Request $request) {
    
    //     $id_credenciamento = $request->credenciamento;
    //     $credenciamento = credenciamento::with('pipeiro')
    //     ->with('veiculo')
    //     ->with('dadosbancarios')
    //     ->with('endereco')
    //     ->find($id_credenciamento);
    
    //     // Arquivos a serem adicionados ao ZIP
    //     $files = [
    //         storage_path('app/public/' . $credenciamento->endereco->comprovanteresidencia) => '1.pdf',
    //         storage_path('app/public/' . $credenciamento->pipeiro->cnhfrente) => '2.pdf',
    //         storage_path('app/public/' . $credenciamento->veiculo->doc_crlv) => '3.pdf',
    //         storage_path('app/public/' . $credenciamento->veiculo->doc_lav) => '4.pdf',
    //         storage_path('app/public/' . $credenciamento->veiculo->veiculo_img) => '5.pdf',
    //         storage_path('app/public/' . $credenciamento->dadosbancarios->doc_comprovante) => '6.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_reqcred) => '7.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_cico) => '8.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_drctvc) => '9.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_maed) => '10.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_cicips) => '11.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_cqe) => '12.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_cqsm) => '13.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_sicaf) => '14.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_ciscc) => '15.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_cndf) => '16.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_cnde) => '17.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_cndm) => '18.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_cidt) => '19.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_antt) => '20.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_lvs) => '21.pdf',
    //         storage_path('app/public/' . $credenciamento->veiculo->doc_cl) => '22.pdf',
    //         storage_path('app/public/' . $credenciamento->doc_act) => '23.pdf',
    //     ];
    
    //     // Caminho da pasta temporária dentro de storage/app/public
    //     $tempFolder = storage_path('app/public/temp');
    //     if (!file_exists($tempFolder)) {
    //         if (!mkdir($tempFolder, 0755, true)) {
    //             return response()->json(['error' => 'Falha ao criar a pasta temporária'], 500);
    //         }
    //     }
    
    //     // Nome do arquivo ZIP e caminho completo
    //     $zipFileName = $credenciamento->pipeiro->cpf . ".zip";
    //     $zipFilePath = $tempFolder . '/' . $zipFileName;
    
    //     // Cria o arquivo ZIP
    //     $zip = new \ZipArchive;
    //     if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
    //         foreach ($files as $originalFilePath => $newFileName) {
    //             if (file_exists($originalFilePath)) {
    //                 $zip->addFile($originalFilePath, $newFileName);
    //             } else {
    //                 continue;
    //                 // return response()->json(['error' => "Arquivo não encontrado: $originalFilePath"], 404);
    //             }
    //         }
    //         $zip->close();
    //     } else {
    //         return response()->json(['error' => 'Não foi possível criar o arquivo ZIP'], 500);
    //     }
    
    //     // Verifica se o arquivo ZIP foi realmente criado
    //     if (!file_exists($zipFilePath)) {
    //         return response()->json(['error' => 'O arquivo ZIP não foi criado'], 500);
    //     }
    
    //     // Retorna o caminho do arquivo ZIP para o frontend
    //     return response()->json(['zipFilePath' => asset('storage/temp/' . $zipFileName),
    //                             "arquivonome"=>$zipFileName]);
    // }
    
    

    private function getEscolaridade($codigo)
    {
        return match ($codigo) {
            "1" => "Ensino Fundamental",
            "2" => "Ensino Fundamental Incompleto",
            "3" => "Ensino Médio",
            "4" => "Ensino Médio Incompleto",
            "5" => "Ensino Superior",
            "6" => "Ensino Superior Incompleto",
            "7" => "Outro",
            default => "Outro",
        };
    }

    private function getEstadoCivil($codigo)
    {
        return match ($codigo) {
            "1" => "Solteiro",
            "2" => "Casado",
            "3" => "União Estável",
            default => "Outro",
        };
    }

    private function getRaca($codigo)
    {
        return match ($codigo) {
            "1" => "Amarelo",
            "2" => "Branco",
            "3" => "Indio",
            "4" => "Pardo",
            "5" => "Negro",
            "6" => "Outros",
            default => "Outros",
        };
    }

    public function buscapipeiro(){
        return view('operador.buscar');
    }

    public function buscarPipeiro(Request $request)
    {
        // Obtém os parâmetros de pesquisa
        $query = $request->input('pesquisa');

        // Busca pelo nome ou CPF
        $pipeiros = Pipeiro_user::where('nome', 'LIKE', "%{$query}%")
            ->orWhere('cpf', 'LIKE', "%{$query}%")
            ->get();

        // Retorna a view com os resultados
        return response()->json(['pipeiros' => $pipeiros]);
    }

    public function detalhesPipeiro($id)
{
    $pipeiro = Pipeiro_user::with('credenciamentos.edital')->find($id);
    if (!$pipeiro) {
        return response()->json(['error' => 'Pipeiro não encontrado'], 404);
    }

    return response()->json($pipeiro);
}

    
}
