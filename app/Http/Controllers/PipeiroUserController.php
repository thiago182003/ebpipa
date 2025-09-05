<?php

namespace App\Http\Controllers;

use App\Models\credenciamento;
use App\Models\dadosbancarios;
use App\Models\Edital;
use App\Models\endereco;
use App\Models\Estado;
use App\Models\Municipio;
use Illuminate\Http\Request;
use App\Models\Pipeiro_user;
use App\Models\pipeiroCredenciamento;
use App\Models\veiculo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class PipeiroUserController extends Controller
{
    //

    public $sestadocivil = [
        'Solteiro' => '1',
        'Casado' => '2',
        'União Estável' => '3',
        'Outro' => '4'
    ];

    public $sraca = [
        'Amarelo' => '1',
        'Branco' => '2',
        'Indio' => '3',
        'Pardo' => '4',
        'Negro' => '5',
        'Outros' => '6',
    ];

    public $sescolaridade = [
        'Ensino Fundamental' => '1',
        'Ensino Fundamental Incomleto' => '2',
        'Ensino Médio' => '3',
        'Ensino Médio Incompleto' => '4',
        'Ensino Superior' => '5',
        'Ensino Superior Incompleto' => '6',
        'Outro' => '7',
    ];

    public $sgenero = [
        'Masculino' => '1',
        'Feminino' => '2',
        'Outro' => '3'
    ];

    public function dashboard()
    {
        $pendencias = CredenciamentoController::checarPendencias(Auth::guard('pipeiro')->user()->id);
        return view('pipeiro.dashboard', compact('pendencias'));
    }

    public function logout(Request $request)
    {
        Auth::guard('pipeiro')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.login');
    }

    public function carregarmunicipios(Request $request){
        $id_edital = $request->id;
        $edital = Edital::find($id_edital);
        $municipios = Municipio::with('estado')->where(['id_om'=>$edital->id_om,'status'=>1])->get();
        $estados = $municipios->pluck('estado')->unique('id')->values();
        return response()->json([
            'municipios' => $municipios,
            'estados' => $estados
        ]);
    }

    private function carregarDadosComuns()
    {
        return [
            'estadocivil' => $this->sestadocivil,
            'raca' => $this->sraca,
            'escolaridade' => $this->sescolaridade,
            'genero' => $this->sgenero,
            // 'estados' => Estado::where('id_om', 2)->get(),
            'todosestados' => Estado::all(),
            'municipios' => Municipio::where('status','1'),
            'bancos' => DB::table('bancos')->get(),
            'editais' => Edital::with(['om.anexos'])->get(),
            'pipeiro' => Auth('pipeiro')->user()
        ];
    }

    private function lerArquivoJson()
    {
        // Caminho do arquivo JSON
        $caminhoArquivo = storage_path('app/data/pessoaFisica-docs.json');
        // dd($caminhoArquivo);
        // Verifica se o arquivo existe
        if (file_exists($caminhoArquivo)) {
            // Lê o conteúdo do arquivo
            $conteudo = file_get_contents($caminhoArquivo);

            // Decodifica o JSON para um array associativo ou objeto
            $dados = json_decode($conteudo,true); // Use 'true' para retornar como array, sem para objeto.

            // Verifica se a decodificação foi bem-sucedida
            if (json_last_error() === JSON_ERROR_NONE) {
                // Retorna ou manipula os dados
                return $dados;
            } else {
                return response()->json(['erro' => 'Erro ao decodificar o JSON: ' . json_last_error_msg()], 500);
            }
        } else {
            return response()->json(['erro' => 'Arquivo não encontrado'], 404);
        }
    }

    public function gerenciarCredenciamento(Request $request)
    {
        $dadosComuns = $this->carregarDadosComuns();
        $usulogadoid = Auth::guard('pipeiro')->user()->id;
        $mensagem = ""; 
        if ($request->has('id')) {
            $credenciamento = credenciamento::pipeiroCompleto($usulogadoid,$request->id)->first();
            if ($credenciamento == null) {
                return redirect()->route('pipeiro.credenciamentos');
            }
            $mensagem = $credenciamento->status == 3 ? 
                        "Sua está sendo analisada. Em breve retorne para maiores informações" : 
                        ($credenciamento->status == 1 ? "Sua documentação está aprovada." : "");
        } else {
            $credenciamento = null; // Ou inicialize um novo objeto se necessário
            $credenciamentos = CredenciamentoController::getCredenciamentos('pipeiro');
            foreach ($dadosComuns['editais'] as $ed) {
                $ed['credenciado'] = $credenciamentos->filter(function($x) use ($ed) {
                    return $x->edital->id == $ed->id;
                })->count();
            }
        }
        $pendencias = CredenciamentoController::checarPendencias($usulogadoid);
        return view('pipeiro.credenciamento', array_merge($dadosComuns, compact(
            'credenciamento', 'pendencias', 'mensagem'
        )));
    }

    public function credenciar(Request $request)
    {
        $idEdital = $request->input_id_edital ?? $request->id_edital; 
        $edital = Edital::find($idEdital);

        $mesmoEdital = false;

        if($request->id_credenciamento == null){
            $creds = CredenciamentoController::getCredenciamentos('pipeiro');
            foreach($creds as $c){
                if($c->edital->id == $idEdital){
                    $mesmoEdital = true;
                }
            }
        }

        if($mesmoEdital){
            $mensagem = "Você ja esta credenciado para este edital. Só é possivel um credenciamento por edital.";
            return redirect()->back()->with('success', $mensagem);
        }

        $pipeiro = Pipeiro_user::find($request->id);
        $pipeiro->fill($request->except('cnhfrente'));
        CredenciamentoController::salvarArquivo($request, $pipeiro, "cnhfrente", $pipeiro->cpf, "cadastro",$edital);
        $pipeiro->save();
        // dd($request->all());
        $credenciamento = $request->id_credenciamento ? credenciamento::find($request->id_credenciamento) : credenciamento::create();
        $endereco = $request->id_endereco  ? endereco::find($request->id_endereco) : new endereco();
        $veiculo = $request->id_veiculo ? veiculo::find($request->id_veiculo) : new veiculo();
        $banco = $request->id_dadosbancarios ? dadosbancarios::find($request->id_dadosbancarios) : new dadosbancarios();
        // $pipeirocred = $request->id_credenciamento ? pipeiroCredenciamento::where("id_credenciamento",$request->id_credenciamento)->first() : new pipeiroCredenciamento();

        $endereco->fill($request->except('id'));
        $endereco->id_pipeiro = $pipeiro->id;
        $endereco->estado = $request->estadores;
        $endereco->id_credenciamento = $credenciamento->id;
        CredenciamentoController::salvarArquivo($request, $endereco, "comprovanteresidencia", $pipeiro->cpf, "cadastro",$edital);
        $endereco->save();

        $veiculo->fill($request->except('id'));
        $veiculo->id_credenciamento = $credenciamento->id;

        CredenciamentoController::salvarArquivo($request, $veiculo, "doc_crlv", $pipeiro->cpf, "veiculo",$edital);
        CredenciamentoController::salvarArquivo($request, $veiculo, "doc_lav", $pipeiro->cpf, "veiculo",$edital);
        CredenciamentoController::salvarArquivo($request, $veiculo, "veiculo_img", $pipeiro->cpf, "veiculo",$edital);
        CredenciamentoController::salvarArquivo($request, $veiculo, "doc_cl", $pipeiro->cpf, "veiculo",$edital);
        $veiculo->save();

        $banco->fill($request->except('id'));
        $banco->id_credenciamento = $credenciamento->id;
        $banco->id_pipeiro = $pipeiro->id;
        CredenciamentoController::salvarArquivo($request, $banco, "doc_comprovante", $pipeiro->cpf, "cadastro",$edital);
        $banco->save();

        $credenciamento->fill($request->except('id'));
        $credenciamento->id_pipeiro = $pipeiro->id;
        $credenciamento->id_veiculo = $veiculo->id;
        $credenciamento->id_municipio = $request->municipio;
        $credenciamento->id_estado = $request->estado;

        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_reqcred", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cico", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cicips", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cqe", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cqsm", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_sicaf", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_ciscc", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cndf", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cnde", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cndm", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cidt", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_antt", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_lvs", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_drctvc", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_maed", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cnis", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_act", $pipeiro->cpf, "credenciamento",$edital);
        $credenciamento->save();
        
        $pendencias = CredenciamentoController::checarCredenciamento($pipeiro->id,$credenciamento->id);
        // dd($pendencias);;
        if (count($pendencias) > 0) {
            $mensagem = "Credenciamento salvo com sucesso. Porém há pendências a resolver.";
        } else if (count($pendencias) == 0) {
            $mensagem = "Credenciamento salvo com sucesso. Pode ser encaminhado para Análise.";
        }

        return redirect()->route('pipeiro.credenciamentos')->with('success', $mensagem);
    }
    
    public function pendencias()
    {    
        $creds = CredenciamentoController::getCredenciamentos('pipeiro');
        $pendencias = CredenciamentoController::checarPendencias(Auth::guard('pipeiro')->user()->id);
        return view('pipeiro.pendencias', compact('pendencias','creds'));
    }

    // public function redcredpdf()
    // {
    //     $pipeiro = Pipeiro_user::find(Auth::guard('pipeiro')->user()->id);
    //     $credenciamento = credenciamento::where("id_pipeiro", $pipeiro->id)->first();
    //     $municipio = Municipio::find($credenciamento->id_municipio);
    //     $veiculo = veiculo::where('id_pipeiro', $pipeiro->id)->first();
    //     $dadosbancarios = dadosbancarios::where('id_pipeiro', $pipeiro->id)->first();
    //     $endereco = endereco::where('id_pipeiro', $pipeiro->id)->first();

    //     return view("requerimentos.credenciamento", compact('pipeiro', 'credenciamento', 'municipio', 'endereco', 'veiculo', 'dadosbancarios'));
    // }

    public function sanarpendencias(Request $request)
    {
        if (!$request->allFiles()) {
            $mensagem = "Não há arquivos para enviar.";
            return redirect()->route('pipeiro.credenciamentos')->with('success', $mensagem);
        }
        $idEdital = $request->id_edital;
        $edital = Edital::find($idEdital);
        $pipeiro = Pipeiro_user::find(Auth::guard('pipeiro')->user()->id);
        CredenciamentoController::salvarArquivo($request, $pipeiro, "cnhfrente", $pipeiro->cpf, "cadastro",$edital);
        $credenciamento = credenciamento::with('endereco')
        ->with('veiculo')
        ->with('dadosbancarios')
        ->where(['id_pipeiro'=>$pipeiro->id,'id_edital'=>$edital->id])
        ->first();
        // dd($credenciamento);
        $pipeiro->save();
        // $cred = credenciamento::join('pipeiro_credenciamentos','credenciamentos.id','=','pipeiro_credenciamentos.id_credenciamento')->where("credenciamentos.id_pipeiro", $pipeiro->id)->where('credenciamentos.id_edital',$idEdital)->select('credenciamentos.*')->first();
        // dd($credenciamento);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_reqcred", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cico", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cicips", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cqe", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cqsm", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_sicaf", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_ciscc", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_ciem", $pipeiro->cpf, "credenciamento");
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cndf", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cnde", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cndm", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cidt", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_antt", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_lvs", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_act", $pipeiro->cpf, "credenciamento");
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_drctvc", $pipeiro->cpf, "credenciamento",$edital);

        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_maed", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cnis", $pipeiro->cpf, "credenciamento",$edital);
        $credenciamento->save();


        // $endereco = endereco::where("id_credenciamento", $credenciamento->id)->first();
        $endereco = $credenciamento->endereco;
        CredenciamentoController::salvarArquivo($request, $endereco, "comprovanteresidencia", $pipeiro->cpf, "cadastro",$edital);
        $endereco->save();

        // $veiculo = veiculo::where("id_credenciamento", $credenciamento->id)->first();
        $veiculo = $credenciamento->veiculo;
        CredenciamentoController::salvarArquivo($request, $veiculo, "doc_crlv", $pipeiro->cpf, "veiculo",$edital);
        CredenciamentoController::salvarArquivo($request, $veiculo, "doc_lav", $pipeiro->cpf, "veiculo",$edital);
        CredenciamentoController::salvarArquivo($request, $veiculo, "veiculo_img", $pipeiro->cpf, "veiculo",$edital);
        CredenciamentoController::salvarArquivo($request, $veiculo, "doc_cl", $pipeiro->cpf, "veiculo",$edital);
        $veiculo->save();

        // $banco = dadosbancarios::where("id_credenciamento", $credenciamento->id)->first();
        $banco = $credenciamento->dadosbancarios;
        CredenciamentoController::salvarArquivo($request, $banco, "doc_comprovante", $pipeiro->cpf, "cadastro",$edital);
        $banco->save();
        
        $pendencias = CredenciamentoController::checarCredenciamento($pipeiro->id,$credenciamento->id);
        if (count($pendencias) > 0) {
            $mensagem = "Credenciamento salvo com sucesso. Porém há pendências a resolver.";
        } else if (count($pendencias) == 0) {
            $mensagem = "Credenciamento salvo com sucesso. Encaminhado para Análise.";
        }
        $credenciamento->save();
        return redirect()->route('pipeiro.credenciamentos');
        // return redirect()->route('pipeiro.credenciamentos')->with('success', $mensagem);
    }

    // public function salvarArquivo($request, &$object, $arquivo, $chave, $pasta,$edital = null)
    // {
    //     CredenciamentoController::salvarArquivo($request,$object,$arquivo,$chave,$pasta,$edital);
    // }

    public function credenciamentos(){
        $id = Auth::guard('pipeiro')->user()->id;
        $pendencias = CredenciamentoController::checarPendencias($id);
        $creds = CredenciamentoController::getCredenciamentos("pipeiro");
        return view("pipeiro.credenciamentos",compact('creds','pendencias'));
    }

    public function alterasenha(){
        return view('pipeiro.alterasenha');
    }

    public function alterarsenha(Request $request){
        // dd($request->all());
        if($request->novasenha != $request->senhaconfirma){
            return back()->withErrors(['current_password' => 'Confirme a senha corretamente']);
        }
        $user = Pipeiro_user::find(Auth::guard('pipeiro')->user()->id);
        $user->password = bcrypt($request->novasenha);
        $user->mudasenha = 0;
        $user->save();
        return redirect()->route('pipeiro.alterasenha')->with('status', 'Senha alterada com sucesso!');
    }

}
