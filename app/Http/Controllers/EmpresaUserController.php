<?php

namespace App\Http\Controllers;

use App\Models\Anexo;
use App\Models\credenciamento;
use App\Models\dadosbancarios;
use App\Models\Edital;
use App\Models\Empresa_user;
use App\Models\empresaCredenciamento;
use App\Models\endereco;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Om;
use App\Models\Pipeiro_user;
use App\Models\pipeiroCredenciamento;
use App\Models\Processo;
use App\Models\veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmpresaUserController extends Controller
{
    //
    public function logout(Request $request)
    {
        Auth::guard('empresa')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.login');
    }

    public function dashboard()
    {
        $pendencias = CredenciamentoController::checarPendenciasEmpresa(Auth::guard('empresa')->user()->id);
        // $pendenciasMotoristas = CredenciamentoController::pendenciasMotorista(Auth::guard('empresa')->user()->id);
        $quantidade = count($pendencias);
        // foreach ($pendenciasMotoristas as $p) {
        //     $quantidade += count($p);
        // }
        return view('empresa.dashboard', compact('pendencias', 'quantidade'));
    }

    public function sanarpendenciasempresa(Request $request)
    {
        if (!$request->allFiles()) {
            // $mensagem = "Não há arquivos para enviar.";
            return redirect()->route("empresa.pendencias");
        }
        $idEdital = $request->id_edital;
        $edital = Edital::find($idEdital);
        $empresa = Empresa_user::find($request->id);
        $credenciamento = credenciamento::where(['id_empresa'=>$empresa->id,'id_edital'=>$request->id_edital])->first();
        // dd($credenciamento);

        CredenciamentoController::salvarArquivo($request, $empresa, "doc_representante", $empresa->cnpj, "empresa",$edital);
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_tdm", $empresa->cnpj, "empresa",$edital); //
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_ccmei", $empresa->cnpj, "empresa",$edital); //
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_cicnpj", $empresa->cnpj, "empresa",$edital); //
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_ciccem", $empresa->cnpj, "empresa",$edital); //
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_crrcss", $empresa->cnpj, "empresa",$edital); //
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_crrc", $empresa->cnpj, "empresa",$edital); //
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_cidijt", $empresa->cnpj, "empresa",$edital); //
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_alf", $empresa->cnpj, "empresa",$edital); //
        $empresa->save();

        //endereço
        if ($endereco = endereco::where('id_credenciamento', $credenciamento->id)->first()) {
            // dd($endereco);
            CredenciamentoController::salvarArquivo($request, $endereco, "comprovanteresidencia", $empresa->cnpj, "empresa",$edital);

            // dd($endereco);
            $endereco->id_empresa = $empresa->id;
            // $endereco->estado = $request->estadores;
            $endereco->save();
        }

        //banco
        if ($banco = dadosbancarios::where('id_credenciamento', $credenciamento->id)->first()) {
            CredenciamentoController::salvarArquivo($request, $banco, "doc_comprovante", $empresa->cnpj, "empresa",$edital);
            $banco->id_empresa = $empresa->id;
            $banco->save();
        }


        // dd($request->all(), $empresa, $endereco, $banco);
        if ($credenciamento) {
            // dd($credenciamento, $empresa->id);
            $credenciamento->id_empresa = $empresa->id;
            // $credenciamento->status = 2;
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_reqcred", $empresa->cnpj, "credenciamento",$edital);
            CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cico", $empresa->cnpj, "credenciamento",$edital); //
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cicips", $empresa->cnpj, "credenciamento",$edital);
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cqe", $empresa->cnpj, "credenciamento",$edital);
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cqsm", $empresa->cnpj, "credenciamento",$edital);
            CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_sicaf", $empresa->cnpj, "credenciamento",$edital); //
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_ciscc", $empresa->cnpj, "credenciamento",$edital);
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_ciem", $empresa->cnpj, "credenciamento",$edital);
            CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cndf", $empresa->cnpj, "credenciamento",$edital); //
            CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cnde", $empresa->cnpj, "credenciamento",$edital); //
            CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cndm", $empresa->cnpj, "credenciamento",$edital); //
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cidt", $empresa->cnpj, "credenciamento",$edital);
            CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_antt", $empresa->cnpj, "credenciamento",$edital); //
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_lvs", $empresa->cnpj, "credenciamento",$edital);
            CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_act", $empresa->cnpj, "credenciamento",$edital); //
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_drctvc", $empresa->cnpj, "credenciamento",$edital);
            CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_maed", $empresa->cnpj, "credenciamento",$edital); //
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cnis", $empresa->cnpj, "credenciamento",$edital);
            $credenciamento->save();
        }

        // dd($credenciamento, $empresa, $request->all());

        $pendencias = CredenciamentoController::checarCredenciamentoEmpresa($empresa->id,$credenciamento->id);
        if (count($pendencias) > 0) {
            $mensagem = "Credenciamento salvo com sucesso. Porém há pendências a resolver.";
        } else if (count($pendencias) == 0) {
            $mensagem = "Credenciamento salvo com sucesso. Encaminhado para Análise.";
        }
        $credenciamento->save();

        return redirect()->route("empresa.pendencias");
    }

    public function credenciamento(Request $request)
    {
        // dd($request->all());
        $pendencias = CredenciamentoController::checarPendenciasEmpresa(Auth::guard('empresa')->user()->id);
        $todosestados = Estado::all();
        $municipios = Municipio::all();
        $editais = Edital::all();
        $empresa = Auth('empresa')->user();
        $credenciamento = credenciamento::find($request->id);
        $dadosbancarios = dadosbancarios::where('id_credenciamento', $credenciamento->id)->first();
        $endereco = endereco::where('id_credenciamento', $credenciamento->id)->first();
        $bancos = DB::table('bancos')->get();
        $novo = "nao";
        $mensagem = $credenciamento->status == 3 ? 
                        "Sua está sendo analisada. Em breve retorne para maiores informações" : 
                        ($credenciamento->status == 1 ? "Sua documentação está aprovada." : "");
        return view('empresa.credenciamento', compact(
            'editais',
            'empresa',
            'municipios',
            'dadosbancarios',
            'endereco',
            'credenciamento',
            'bancos',
            'todosestados',
            'pendencias',
            'novo',
            'mensagem'
        ));
    }

    public function novocredenciamento()
    {
        $pendencias = CredenciamentoController::checarPendenciasEmpresa(Auth::guard('empresa')->user()->id);
        $todosestados = Estado::all();
        $credenciamentos = CredenciamentoController::getCredenciamentos('empresa');
        $editais = Edital::with('om.anexos')->get();
        $editais->each(function ($ed) use ($credenciamentos) {
            $ed['credenciado'] = $credenciamentos->contains(function ($credenciamento) use ($ed) {
                return $credenciamento->id_edital == $ed->id;
            });
        });
        $mensagem = "";
        $empresa = Auth('empresa')->user();
        $bancos = DB::table('bancos')->get();
        $novo = "sim";
        return view('empresa.credenciamento', compact(
            'editais',
            'empresa',
            'bancos',
            'todosestados',
            'pendencias',
            'novo',
            'mensagem'
        ));
    }

    public function credenciar(Request $request)
    {
        $idEdital = $request->input_id_edital ;
        if($idEdital == "" || $idEdital == null ){
            $idEdital = $request->id_edital;
        }
        $edital = Edital::find($idEdital);

        $mesmoEdital = false;

        if($request->id_credenciamento == null){
            $creds = CredenciamentoController::getCredenciamentos('empresa');
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

        $empresa = Empresa_user::find($request->id);
        $empresa->fill($request->all());
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_representante", $empresa->cnpj, "empresa",$edital);
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_tdm", $empresa->cnpj, "empresa",$edital); //
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_ccmei", $empresa->cnpj, "empresa",$edital); //
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_cicnpj", $empresa->cnpj, "empresa",$edital); //
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_ciccem", $empresa->cnpj, "empresa",$edital); //
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_crrcss", $empresa->cnpj, "empresa",$edital); //
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_crrc", $empresa->cnpj, "empresa",$edital); //
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_cidijt", $empresa->cnpj, "empresa",$edital); //
        CredenciamentoController::salvarArquivo($request, $empresa, "doc_emp_alf", $empresa->cnpj, "empresa",$edital); //
        $empresa->save();

        if($request->novo == "sim"){
            $credenciamento = credenciamento::create();
            $endereco = endereco::create();
            $banco = dadosbancarios::create();
            $empresacred = empresaCredenciamento::create();
            $empresacred->status = 1;
        }else{
            $credenciamento = credenciamento::find($request->id_credenciamento);
            $endereco = endereco::where("id_credenciamento",$request->id_credenciamento)->first();
            $banco = dadosbancarios::where("id_credenciamento",$request->id_credenciamento)->first();
            // dd($banco);
            $empresacred = empresaCredenciamento::where("id_credenciamento",$request->id_credenciamento)->first();
        }
        
        //endereço
        CredenciamentoController::salvarArquivo($request, $endereco, "comprovanteresidencia", $empresa->cnpj, "empresa",$edital);
        $endereco->fill($request->except('comprovanteresidencia','id'));
        $endereco->id_empresa = $empresa->id;
        $endereco->estado = $request->estadores;
        $endereco->id_credenciamento = $credenciamento->id;
        $endereco->save();
        
        //banco
        CredenciamentoController::salvarArquivo($request, $banco, "doc_comprovante", $empresa->cnpj, "empresa",$edital);
        $banco->fill($request->except('doc_comprovante','id'));
        $banco->id_empresa = $empresa->id;
        $banco->id_credenciamento = $credenciamento->id;
        $banco->save();

        $credenciamento->fill($request->except('id'));
        $credenciamento->id_empresa = $empresa->id;
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cico", $empresa->cnpj, "credenciamento",$edital); //
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_sicaf", $empresa->cnpj, "credenciamento",$edital); //
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cndf", $empresa->cnpj, "credenciamento",$edital); //
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cnde", $empresa->cnpj, "credenciamento",$edital); //
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cndm", $empresa->cnpj, "credenciamento",$edital); //
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_antt", $empresa->cnpj, "credenciamento",$edital); //
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_act", $empresa->cnpj, "credenciamento",$edital); //
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_maed", $empresa->cnpj, "credenciamento",$edital); //
        $credenciamento->save();
        // dd($credenciamento);
        $pendencias = CredenciamentoController::checarCredenciamentoEmpresa($empresa->id,$credenciamento->id);
        // dd($pendencias);
        if (count($pendencias) > 0) {
            // $credenciamento->status = 99;
            $mensagem = "Credenciamento salvo com sucesso. Porém há pendências a resolver.";
        } else if (count($pendencias) == 0) {
            // $credenciamento->status = 3;
            $mensagem = "Credenciamento salvo com sucesso. Pode ser encaminhado para Análise.";
        }
        // $credenciamento->save();
        // $empresacred->id_empresa = $empresa->id;
        // $empresacred->id_credenciamento = $credenciamento->id;
        // $empresacred->save();
        
        // dd("aqui");
        return redirect()->route('empresa.credenciamentos')->with('success', $mensagem);
    }

    public function salvarArquivo($request, &$object, $arquivo, $chave, $pasta,$edital = null)
    {
        CredenciamentoController::salvarArquivo($request,$object,$arquivo,$chave,$pasta,$edital);
    }

    public function pendencias()
    {
        $creds = $this->getCredenciamentos();
        $empresa = Auth::guard('empresa')->user();
        $pendencias = CredenciamentoController::checarPendenciasEmpresa(Auth::guard('empresa')->user()->id);
        $pendenciasMotoristas = CredenciamentoController::pendenciasMotorista(Auth::guard('empresa')->user()->id);
        $quantidade = count($pendencias);
        foreach ($pendenciasMotoristas as $p) {
            $quantidade += count($p);
        }
        // dd($pendencias);
        return view('empresa.pendencias', compact('pendencias', 'pendenciasMotoristas', 'quantidade', 'empresa','creds'));
    }

    public function deletarArquivo(Request $request)
    {
        CredenciamentoController::deletarArquivo($request);
    }

    public function motoristas()
    {
        // return view("manutencao");
        $empresa = auth('empresa')->user();
        $credenciamentos = credenciamento::empresaCompleto(auth('empresa')->user()->id);
        //todos os motoristas da empresa
        $motoristas = credenciamento::motoristas(auth('empresa')->user()->id);
        $pendencias = CredenciamentoController::checarPendenciasEmpresa(Auth::guard('empresa')->user()->id);
        $quantidade = count($pendencias);
        //percorre todos os motoristas 
        foreach ($motoristas as $mot) {
            $mot->status = CredenciamentoController::credStatus($mot->status); 
            $mot->pendencias = CredenciamentoController::checarPendenciasPipeiroEmpresa($mot->pipeiro->id,$mot->id);
            // dd($mot->pendencias);
            $quantidade += count($mot->pendencias);
        }

        return view('empresa.motoristas', compact('motoristas', 'pendencias', 'quantidade','empresa','credenciamentos'));
    }

    public function addmotorista(Request $request)
    {
        $pendencias = CredenciamentoController::checarPendenciasEmpresa(Auth::guard('empresa')->user()->id);
        $estadocivil = [
            'Solteiro' => '1',
            'Casado' => '2',
            'União Estável' => '3',
            'Outro' => '4'
        ];

        $raca = [
            'Amarelo' => '1',
            'Branco' => '2',
            'Indio' => '3',
            'Pardo' => '4',
            'Negro' => '5',
            'Outros' => '6',
        ];

        $escolaridade = [
            'Ensino Fundamental' => '1',
            'Ensino Fundamental Incomleto' => '2',
            'Ensino Médio' => '3',
            'Ensino Médio Incompleto' => '4',
            'Ensino Superior' => '5',
            'Ensino Superior Incompleto' => '6',
            'Outro' => '7',
        ];

        $genero = [
            'Masculino' => '1',
            'Feminino' => '2',
            'Outro' => '3'
        ];
        $novo = "sim";
        $mensagem = "";
        if($request->pipeiro != "" || $request->pipeiro != null){
            $pipeiro = Pipeiro_user::find($request->pipeiro);
            $credenciamento = credenciamento::find($request->credenciamento);
            $veiculo = veiculo::where("id_credenciamento",$credenciamento->id)->first();
            $novo="nao";
            $mensagem = $credenciamento->status == 3 ? 
                        "Sua está sendo analisada. Em breve retorne para maiores informações" : 
                        ($credenciamento->status == 1 ? "Sua documentação está aprovada." : "");
            // $endereco = veiculo::where("id_credenciamento",$credenciamento->id);
        }
        $todosestados = Estado::all();
        $municipios = Municipio::all();
        $credenciamentos = $this->getCredenciamentos();
        
        $editais = Edital::all();
        foreach($editais as $ed){
            $teste = 2;
            $ed->credenciado = $credenciamentos->filter(function($x) use ($ed){
                return $x->edital->id == $ed->id;
            })->count();
            $ed->om = OM::find($ed->id_om);
            $ed->anexos = Anexo::where('id_om',$ed->id_om)->first();
            $ed->documento = url("storage/$ed->documento");
        }
        // dd($editais);
        
        if($request->pipeiro == "" || $request->pipeiro == null){
            return view('empresa.adicionar', compact(
                'editais',
                'municipios',
                'escolaridade',
                'raca',
                'estadocivil',
                'genero',
                'todosestados',
                'pendencias',
                'novo',
                'mensagem'
            ));
        }else{
            // dd($veiculo,$credenciamento,$pipeiro);
            return view('empresa.adicionar', compact(
                'editais',
                'municipios',
                'escolaridade',
                'raca',
                'estadocivil',
                'genero',
                'todosestados',
                'pendencias',
                'novo',
                'pipeiro',
                'credenciamento',
                'veiculo',
                'mensagem'
            ));
        }
    }

    public function credenciarPipeiro(Request $request)
    {
        $empresa = Empresa_user::find(Auth('empresa')->user()->id);
       
        $idEdital = $request->input_id_edital;
        if($idEdital == "" || $idEdital == null){
            $idEdital = $request->id_edital;
        }
        $edital = Edital::find($idEdital);
        $cpf_pipeiro = $request->cpf;
        $pipeiro = Pipeiro_user::where('cpf',$cpf_pipeiro)->first();
        // dd($pipeiro);
        if($pipeiro == null){
            $pipeiro = new Pipeiro_user();
            $credenciamento = credenciamento::create();
            $endereco = endereco::create();
            $veiculo = veiculo::create();
        }else{
            //pipeiro ja esta cadastrado no sistema
            $mesmoEdital = false;
            
            if($request->id_credenciamento == null){
                $creds = CredenciamentoController::getCredenciamentos("motorista",$pipeiro->id);
                foreach($creds as $c){
                    if($c->edital->id == $idEdital){
                        $mesmoEdital = true;
                    }
                }
            }
    
            if($mesmoEdital){
                
                $mensagem = "Pipeiro já credenciado para este EDITAL.";
                return redirect()->back()->with('mensagem', $mensagem);
            }
            // dd($request->id_credenciamento);
            if($request->id_credenciamento == null){
                //novo credenciamento
                $credenciamento = credenciamento::create();
            }else{
                //atualizar credenciamento
                $credenciamento = credenciamento::find($request->id_credenciamento);
            }
            // dd($credenciamento);
            $veiculo = veiculo::where("id_credenciamento",$credenciamento->id)->first() ?? veiculo::create();
            $endereco = endereco::where("id_credenciamento",$credenciamento->id)->first() ?? endereco:: create();
        }
        
        //preenche os dados do pipeiro
        $pipeiro->fill($request->except(['cnhfrente','id']));
       
        CredenciamentoController::salvarArquivo($request, $pipeiro, "cnhfrente", $pipeiro->cpf, "cadastro",$edital);
        $pipeiro->id_empresa = $empresa->id;
        //um dia o pipeiro vai poder acessar mesmo sendo apenas pessoa juridica
        if (!@$request->password) {
            $pipeiro->password = bcrypt($pipeiro->cpf);
        }
        // dd($pipeiro);
        $pipeiro->save();

        //preenche os dados do credenciamento
        $credenciamento->fill($request->except('id'));
        $credenciamento->id_pipeiro = $pipeiro->id;
        $credenciamento->id_empresa = $empresa->id;
        $credenciamento->id_veiculo = $veiculo->id;
        $credenciamento->id_municipio = $request->municipio;
        $credenciamento->id_estado = $request->estado;
        $credenciamento->id_edital = $idEdital;
        // dd($request->all(),$credenciamento);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_reqcred", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_antt", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_lvs", $pipeiro->cpf, "credenciamento",$edital);
        CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_drctvc", $pipeiro->cpf, "credenciamento",$edital);
        $credenciamento->save();

        //preenche os dados do endereço
        $endereco->fill($request->except('id'));
        $endereco->id_pipeiro = $pipeiro->id;
        $endereco->estado = $request->estadores;
        $endereco->id_credenciamento = $credenciamento->id;
        

        // CredenciamentoController::salvarArquivo($request, $endereco, "comprovanteresidencia", $pipeiro->cpf, "cadastro",$edital);
        $endereco->save();

        //preenche os dados do veiculo
        $veiculo->fill($request->except('id'));
        CredenciamentoController::salvarArquivo($request, $veiculo, "doc_crlv", $pipeiro->cpf, "veiculo",$edital);
        CredenciamentoController::salvarArquivo($request, $veiculo, "doc_lav", $pipeiro->cpf, "veiculo",$edital);
        CredenciamentoController::salvarArquivo($request, $veiculo, "veiculo_img", $pipeiro->cpf, "veiculo",$edital);
        CredenciamentoController::salvarArquivo($request, $veiculo, "doc_cl", $pipeiro->cpf, "veiculo",$edital);
        $veiculo->id_credenciamento = $credenciamento->id;
        $veiculo->id_pipeiro = $pipeiro->id;
        $veiculo->save();

        // dd($pipeiro,$credenciamento);

        $pendencias = CredenciamentoController::checarCredenciamento($pipeiro->id,$credenciamento->id);
        if (count($pendencias) > 0) {
            $mensagem = "Credenciamento salvo com sucesso. Porém há pendências a resolver.";
        } else if (count($pendencias) == 0) {
            $mensagem = "Credenciamento salvo com sucesso. Encaminhado para Análise.";
        }
        
        return redirect()->route('empresa.motoristas', $pipeiro->id)->with('success', $mensagem);
    }

    public function salvarmotorista(Request $request)
    {
        $this->credenciarPipeiro($request);
        return redirect()->route('empresa.motoristas');
    }

    public function pendenciasmotorista($id,$cred)
    {
        // dd($id,$cred);
        $pipeiro = Pipeiro_user::find($id);
        $pendencias = CredenciamentoController::checarPendenciasEmpresa(Auth('empresa')->user()->id,$cred);
        $pendenciasmotorista = CredenciamentoController::checarPendenciasPipeiroEmpresa($id,$cred);
        $credenciamento = credenciamento::find($cred);
        return view("empresa.pendenciasmotorista", compact("pipeiro", "pendenciasmotorista", 'pendencias','credenciamento'));
    }

    public function sanarpendenciasmotorista(Request $request)
    {
        
        if (!$request->allFiles()) {
            // $mensagem = "Não há arquivos para enviar.";
            return redirect()->route('empresa.motoristas');
        }
        $pipeiro = Pipeiro_user::find($request->id);
        $edital = Edital::find($request->id_edital);
        // dd($edital);
        // dd($request->all(), $pipeiro);
        CredenciamentoController::salvarArquivo($request, $pipeiro, "cnhfrente", $pipeiro->cpf, "cadastro",$edital);
        $pipeiro->save();

        // if ($endereco = endereco::where("id_pipeiro", $pipeiro->id)->first()) {
        //     CredenciamentoController::salvarArquivo($request, $endereco, "comprovanteresidencia", $pipeiro->cpf, "cadastro",$edital);
        //     $endereco->save();
        // }


        if ($veiculo = veiculo::where("id_credenciamento", $request->id_credenciamento)->first()) {
            CredenciamentoController::salvarArquivo($request, $veiculo, "doc_crlv", $pipeiro->cpf, "veiculo",$edital);
            CredenciamentoController::salvarArquivo($request, $veiculo, "doc_lav", $pipeiro->cpf, "veiculo",$edital);
            CredenciamentoController::salvarArquivo($request, $veiculo, "veiculo_img", $pipeiro->cpf, "veiculo",$edital);
            CredenciamentoController::salvarArquivo($request, $veiculo, "doc_cl", $pipeiro->cpf, "veiculo",$edital);
            $veiculo->save();
        }


        // if ($banco = dadosbancarios::where("id_pipeiro", $pipeiro->id)->first()) {
        //     CredenciamentoController::salvarArquivo($request, $banco, "doc_comprovante", $pipeiro->cpf, "cadastro");
        //     $banco->save();
        // }


        if ($credenciamento = credenciamento::find($request->id_credenciamento)) {
            CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_reqcred", $pipeiro->cpf, "credenciamento",$edital);
            CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_drctvc", $pipeiro->cpf, "credenciamento",$edital);
            CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cicips", $pipeiro->cpf, "credenciamento",$edital);
            CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_antt", $pipeiro->cpf, "credenciamento",$edital);
            CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_lvs", $pipeiro->cpf, "credenciamento",$edital);

            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cico", $pipeiro->cpf, "credenciamento");
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cqe", $pipeiro->cpf, "credenciamento");
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cqsm", $pipeiro->cpf, "credenciamento");
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_sicaf", $pipeiro->cpf, "credenciamento");
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_ciscc", $pipeiro->cpf, "credenciamento");
            //CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_ciem", $pipeiro->cpf, "credenciamento");
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cndf", $pipeiro->cpf, "credenciamento");
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cnde", $pipeiro->cpf, "credenciamento");
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cndm", $pipeiro->cpf, "credenciamento");
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cidt", $pipeiro->cpf, "credenciamento");
            //CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_act", $pipeiro->cpf, "credenciamento");
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_maed", $pipeiro->cpf, "credenciamento");
            // CredenciamentoController::salvarArquivo($request, $credenciamento, "doc_cnis", $pipeiro->cpf, "credenciamento");
            $credenciamento->save();
        }

        return redirect()->route("empresa.motoristas");
    }

    public function credenciamentos(){
        $id = Auth::guard('empresa')->user()->id;
        $pendencias = CredenciamentoController::checarPendenciasEmpresa($id);
        $creds = $this->getCredenciamentos();
        
        return view("empresa.credenciamentos",compact('creds','pendencias'));
    }


    public function getCredenciamentos(){
        return CredenciamentoController::getCredenciamentos("empresa");
    }

    public function alterasenha(){
        return view('empresa.alterasenha');
    }

    public function alterarsenha(Request $request){
        // dd($request->all());
        if($request->novasenha != $request->senhaconfirma){
            return back()->withErrors(['current_password' => 'Confirme a senha corretamente']);
        }

        // // dd($request->senhaantiga, Auth::guard('operador')->user()->password);
        // // Verifica se a senha atual está correta
        // if (!Hash::check($request->senhaantiga, Auth::guard('operador')->user()->password)) {
        //     return back()->withErrors(['current_password' => 'A senha atual está incorreta']);
        // }

        $user = Empresa_user::find(Auth::guard('empresa')->user()->id);
        $user->password = bcrypt($request->novasenha);
        $user->mudasenha = 0;
        $user->save();
    
        return redirect()->route('empresa.alterasenha')->with('status', 'Senha alterada com sucesso!');
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

    public function pesquisaCPF(Request $request){
        
        $pipeiro = Pipeiro_user::where('cpf',$request->cpf)->first();
        return $pipeiro;
    }
}
