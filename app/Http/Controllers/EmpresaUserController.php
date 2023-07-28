<?php

namespace App\Http\Controllers;

use App\Models\credenciamento;
use App\Models\dadosbancarios;
use App\Models\Edital;
use App\Models\Empresa_user;
use App\Models\endereco;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Pipeiro_user;
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
        $pendenciasMotoristas = CredenciamentoController::pendenciasMotorista(Auth::guard('empresa')->user()->id);
        $quantidade = count($pendencias);
        foreach ($pendenciasMotoristas as $p) {
            $quantidade += count($p);
        }
        return view('empresa.dashboard', compact('pendencias', 'pendenciasMotoristas', 'quantidade'));
    }

    public function sanarpendenciasempresa(Request $request)
    {
        // dd($request->all());
        $empresa = Empresa_user::find($request->id);

        $this->salvarArquivo($request, $empresa, "doc_representante", $empresa->cnpj, "empresa");
        $this->salvarArquivo($request, $empresa, "doc_emp_tdm", $empresa->cnpj, "empresa"); //
        $this->salvarArquivo($request, $empresa, "doc_emp_ccmei", $empresa->cnpj, "empresa"); //
        $this->salvarArquivo($request, $empresa, "doc_emp_cicnpj", $empresa->cnpj, "empresa"); //
        $this->salvarArquivo($request, $empresa, "doc_emp_ciccem", $empresa->cnpj, "empresa"); //
        $this->salvarArquivo($request, $empresa, "doc_emp_crrcss", $empresa->cnpj, "empresa"); //
        $this->salvarArquivo($request, $empresa, "doc_emp_crrc", $empresa->cnpj, "empresa"); //
        $this->salvarArquivo($request, $empresa, "doc_emp_cidijt", $empresa->cnpj, "empresa"); //
        $this->salvarArquivo($request, $empresa, "doc_emp_alf", $empresa->cnpj, "empresa"); //
        $empresa->save();

        //endereço
        if ($endereco = endereco::where('id_empresa', $empresa->id)->first()) {
            $this->salvarArquivo($request, $endereco, "comprovanteresidencia", $empresa->cnpj, "empresa");

            // dd($endereco);
            $endereco->id_empresa = $empresa->id;
            $endereco->estado = $request->estadores;
            $endereco->save();
        }

        //banco
        if ($banco = dadosbancarios::where('id_empresa', $empresa->id)->first()) {
            $this->salvarArquivo($request, $banco, "doc_comprovante", $empresa->cnpj, "empresa");
            $banco->id_empresa = $empresa->id;
            $banco->save();
        }


        // dd($request->all(), $empresa, $endereco, $banco);
        if ($credenciamento = credenciamento::where('id_empresa', $empresa->id)->first()) {
            // dd($credenciamento, $empresa->id);
            $credenciamento->id_empresa = $empresa->id;
            $credenciamento->status = 2;
            // $this->salvarArquivo($request, $credenciamento, "doc_reqcred", $empresa->cnpj, "credenciamento");
            $this->salvarArquivo($request, $credenciamento, "doc_cico", $empresa->cnpj, "credenciamento"); //
            // $this->salvarArquivo($request, $credenciamento, "doc_cicips", $empresa->cnpj, "credenciamento");
            // $this->salvarArquivo($request, $credenciamento, "doc_cqe", $empresa->cnpj, "credenciamento");
            // $this->salvarArquivo($request, $credenciamento, "doc_cqsm", $empresa->cnpj, "credenciamento");
            $this->salvarArquivo($request, $credenciamento, "doc_sicaf", $empresa->cnpj, "credenciamento"); //
            // $this->salvarArquivo($request, $credenciamento, "doc_ciscc", $empresa->cnpj, "credenciamento");
            // $this->salvarArquivo($request, $credenciamento, "doc_ciem", $empresa->cnpj, "credenciamento");
            $this->salvarArquivo($request, $credenciamento, "doc_cndf", $empresa->cnpj, "credenciamento"); //
            $this->salvarArquivo($request, $credenciamento, "doc_cnde", $empresa->cnpj, "credenciamento"); //
            $this->salvarArquivo($request, $credenciamento, "doc_cndm", $empresa->cnpj, "credenciamento"); //
            // $this->salvarArquivo($request, $credenciamento, "doc_cidt", $empresa->cnpj, "credenciamento");
            $this->salvarArquivo($request, $credenciamento, "doc_antt", $empresa->cnpj, "credenciamento"); //
            // $this->salvarArquivo($request, $credenciamento, "doc_lvs", $empresa->cnpj, "credenciamento");
            $this->salvarArquivo($request, $credenciamento, "doc_act", $empresa->cnpj, "credenciamento"); //
            // $this->salvarArquivo($request, $credenciamento, "doc_drctvc", $empresa->cnpj, "credenciamento");
            $this->salvarArquivo($request, $credenciamento, "doc_maed", $empresa->cnpj, "credenciamento"); //
            // $this->salvarArquivo($request, $credenciamento, "doc_cnis", $empresa->cnpj, "credenciamento");
            $credenciamento->save();
        }

        // dd($credenciamento, $empresa, $request->all());

        $pendencias = CredenciamentoController::checarPendenciasEmpresa($empresa->id);
        if (count($pendencias) > 0) {
            $credenciamento->status = 99;
            $mensagem = "Credenciamento salvo com sucesso. Porém há pendências a resolver.";
        } else if (count($pendencias) == 0) {
            $credenciamento->status = 3;
            $mensagem = "Credenciamento salvo com sucesso. Encaminhado para Análise.";
        }
        $credenciamento->save();

        return redirect()->route("empresa.pendencias");
    }

    public function credenciamento()
    {
        $pendencias = CredenciamentoController::checarPendenciasEmpresa(Auth::guard('empresa')->user()->id);
        $estados = Estado::where('id_om', 2)->get();
        $todosestados = Estado::all();
        $municipios = Municipio::all();
        $editais = Edital::all();
        $empresa = Auth('empresa')->user();
        $credenciamento = credenciamento::where("id_empresa", $empresa->id)->first();
        $processos = Processo::where('id_edital', $editais[0]->id)->get();
        $veiculo = veiculo::where('id_empresa', $empresa->id)->first();
        $dadosbancarios = dadosbancarios::where('id_empresa', $empresa->id)->first();
        $endereco = endereco::where('id_empresa', $empresa->id)->first();
        $bancos = DB::table('bancos')->get();
        return view('empresa.credenciamento', compact(
            'editais',
            'empresa',
            'processos',
            'estados',
            'municipios',
            'veiculo',
            'dadosbancarios',
            'endereco',
            'credenciamento',
            'bancos',
            'todosestados',
            'pendencias'
        ));
    }

    public function credenciar(Request $request)
    {
        // dd($request->all());
        $empresa = Empresa_user::find($request->id);
        $empresa->fill($request->all());
        $this->salvarArquivo($request, $empresa, "doc_representante", $empresa->cnpj, "empresa");
        $this->salvarArquivo($request, $empresa, "doc_emp_tdm", $empresa->cnpj, "empresa"); //
        $this->salvarArquivo($request, $empresa, "doc_emp_ccmei", $empresa->cnpj, "empresa"); //
        $this->salvarArquivo($request, $empresa, "doc_emp_cicnpj", $empresa->cnpj, "empresa"); //
        $this->salvarArquivo($request, $empresa, "doc_emp_ciccem", $empresa->cnpj, "empresa"); //
        $this->salvarArquivo($request, $empresa, "doc_emp_crrcss", $empresa->cnpj, "empresa"); //
        $this->salvarArquivo($request, $empresa, "doc_emp_crrc", $empresa->cnpj, "empresa"); //
        $this->salvarArquivo($request, $empresa, "doc_emp_cidijt", $empresa->cnpj, "empresa"); //
        $this->salvarArquivo($request, $empresa, "doc_emp_alf", $empresa->cnpj, "empresa"); //
        $empresa->save();
        //endereço
        $endereco = endereco::firstOrNew(['id_empresa' => $empresa->id]);
        $this->salvarArquivo($request, $endereco, "comprovanteresidencia", $empresa->cnpj, "empresa");
        $endereco->fill($request->except('comprovanteresidencia'));
        // dd($endereco);
        $endereco->id_empresa = $empresa->id;
        $endereco->estado = $request->estadores;
        $endereco->save();
        //banco
        $banco = dadosbancarios::firstOrNew(['id_empresa' => $empresa->id]);
        $this->salvarArquivo($request, $banco, "doc_comprovante", $empresa->cnpj, "empresa");
        $banco->fill($request->except('doc_comprovante'));
        $banco->id_empresa = $empresa->id;
        $banco->save();

        // dd($request->all(), $empresa, $endereco, $banco);
        $credenciamento = credenciamento::firstOrNew(['id_empresa' => $empresa->id]);
        $credenciamento->fill($request->all());
        $credenciamento->id_empresa = $empresa->id;
        $credenciamento->status = 2;
        // $this->salvarArquivo($request, $credenciamento, "doc_reqcred", $empresa->cnpj, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cico", $empresa->cnpj, "credenciamento"); //
        // $this->salvarArquivo($request, $credenciamento, "doc_cicips", $empresa->cnpj, "credenciamento");
        // $this->salvarArquivo($request, $credenciamento, "doc_cqe", $empresa->cnpj, "credenciamento");
        // $this->salvarArquivo($request, $credenciamento, "doc_cqsm", $empresa->cnpj, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_sicaf", $empresa->cnpj, "credenciamento"); //
        // $this->salvarArquivo($request, $credenciamento, "doc_ciscc", $empresa->cnpj, "credenciamento");
        // $this->salvarArquivo($request, $credenciamento, "doc_ciem", $empresa->cnpj, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cndf", $empresa->cnpj, "credenciamento"); //
        $this->salvarArquivo($request, $credenciamento, "doc_cnde", $empresa->cnpj, "credenciamento"); //
        $this->salvarArquivo($request, $credenciamento, "doc_cndm", $empresa->cnpj, "credenciamento"); //
        // $this->salvarArquivo($request, $credenciamento, "doc_cidt", $empresa->cnpj, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_antt", $empresa->cnpj, "credenciamento"); //
        // $this->salvarArquivo($request, $credenciamento, "doc_lvs", $empresa->cnpj, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_act", $empresa->cnpj, "credenciamento"); //
        // $this->salvarArquivo($request, $credenciamento, "doc_drctvc", $empresa->cnpj, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_maed", $empresa->cnpj, "credenciamento"); //
        // $this->salvarArquivo($request, $credenciamento, "doc_cnis", $empresa->cnpj, "credenciamento");

        $credenciamento->save();
        // dd($credenciamento, $empresa, $request->all());

        $pendencias = CredenciamentoController::checarPendenciasEmpresa($empresa->id);
        if (count($pendencias) > 0) {
            $credenciamento->status = 99;
            $mensagem = "Credenciamento salvo com sucesso. Porém há pendências a resolver.";
        } else if (count($pendencias) == 0) {
            $credenciamento->status = 3;
            $mensagem = "Credenciamento salvo com sucesso. Encaminhado para Análise.";
        }
        $credenciamento->save();
        return redirect()->route('empresa.credenciamento')->with('success', $mensagem);
    }

    public function salvarArquivo($request, &$object, $arquivo, $chave, $pasta)
    {
        // dd($object);
        if ($request->hasFile($arquivo)) {
            $file = $request->file($arquivo);
            // dd($file, $object[$arquivo]);
            if ($object[$arquivo] && Storage::exists($object[$arquivo])) {
                Storage::delete($object[$arquivo]);
            }
            // dd("fora");
            $extension = strtolower($file->getClientOriginalExtension());
            if ($extension === 'pdf') {
                $caminho = $file->store($chave . '/' . $pasta);
                // dd($caminho);
                $object[$arquivo] = $caminho;
                $object[$arquivo . "_status"] = "1";
                $object[$arquivo . "_obs"] = "";
            } else {
                // dd("nao");
                $object[$arquivo] = "";
                $object[$arquivo . "_status"] = "99";
                $object[$arquivo . "_obs"] = "O arquivo não era um PDF";
            }
        }
    }

    public function pendencias()
    {
        $empresa = Auth::guard('empresa')->user();
        $pendencias = CredenciamentoController::checarPendenciasEmpresa(Auth::guard('empresa')->user()->id);
        $pendenciasMotoristas = CredenciamentoController::pendenciasMotorista(Auth::guard('empresa')->user()->id);
        // dd($todaspendencias);
        $quantidade = count($pendencias);
        foreach ($pendenciasMotoristas as $p) {
            $quantidade += count($p);
        }
        return view('empresa.pendencias', compact('pendencias', 'pendenciasMotoristas', 'quantidade', 'empresa'));
    }

    public function deletarArquivo(Request $request)
    {
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
            case "empresa":
                $class = Empresa_user::find(auth('empresa')->user()->id);
                break;
            case "veiculo":
                $class = veiculo::find($request->id);
                break;
        }
        // dd($class);
        if (Storage::exists($class["$request->arquivo"])) {
            Storage::delete($class["$request->arquivo"]);
        }
        $class["$request->arquivo"] = "";
        $class["$request->arquivo" . "_status"] = "99";
        $class["$request->arquivo" . "_obs"] = "";
        $class->save();
    }

    public function motoristas()
    {
        $empresa = auth('empresa')->user();
        $motoristas = Pipeiro_user::where('id_empresa', $empresa->id)->get();
        $pendencias = CredenciamentoController::checarPendenciasEmpresa(Auth::guard('empresa')->user()->id);

        $quantidade = count($pendencias);
        // $pendenciasMotoristas = CredenciamentoController::pendenciasMotorista(Auth::guard('empresa')->user()->id);
        foreach ($motoristas as $mot) {
            $mot['pendencias'] = CredenciamentoController::checarPendenciasPipeiroEmpresa($mot->id);
            $quantidade += count($mot['pendencias']);
        }
        // dd($motoristas);
        return view('empresa.motoristas', compact('empresa', 'motoristas', 'pendencias', 'quantidade'));
    }

    public function addmotorista($id = null)
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

        if ($id == null) {
            $estados = Estado::where('id_om', 2)->get();
            $todosestados = Estado::all();
            $municipios = Municipio::all();
            $editais = Edital::all();
            @$pipeiro = new Pipeiro_user();
            @$credenciamento = new credenciamento();
            // dd($credenciamento);
            @$processos = new Processo();
            @$veiculo = new veiculo();
            @$dadosbancarios = new dadosbancarios();
            @$endereco = new endereco();
        } else {
            $estados = Estado::where('id_om', 2)->get();
            $todosestados = Estado::all();
            $municipios = Municipio::all();
            $editais = Edital::all();
            $pipeiro = Pipeiro_user::find($id);
            $credenciamento = credenciamento::firstOrNew(['id_pipeiro' => $pipeiro->id]);
            $processos = new Processo();
            $veiculo = veiculo::firstOrNew(['id_pipeiro' => $pipeiro->id]);;
            $dadosbancarios = dadosbancarios::firstOrNew(['id_pipeiro' => $pipeiro->id]);
            $endereco = endereco::firstOrNew(['id_pipeiro' => $pipeiro->id]);
        }

        return view('empresa.adicionar', compact(
            'editais',
            'pipeiro',
            'processos',
            'estados',
            'municipios',
            'escolaridade',
            'raca',
            'estadocivil',
            'veiculo',
            'dadosbancarios',
            'endereco',
            'credenciamento',
            'genero',
            'todosestados',
            'pendencias'
        ));
    }

    public function credenciarPipeiro(Request $request)
    {
        $empresa = Empresa_user::find(Auth('empresa')->user()->id);
        $credenciamentoEmpresa = credenciamento::where('id_empresa', $empresa->id)->first();
        $pipeiro = Pipeiro_user::firstOrNew(['id' => $request->id]);

        $pipeiro->id_empresa = $empresa->id;
        if (!@$request->password) {
            $request["password"] = bcrypt('123456');
        }
        $pipeiro->fill($request->except('cnhfrente'));
        $this->salvarArquivo($request, $pipeiro, "cnhfrente", $pipeiro->cpf, "cadastro");
        $pipeiro->save();

        $endereco = endereco::firstOrNew(['id_pipeiro' => $pipeiro->id]);
        $endereco->fill($request->all());
        $endereco->id_pipeiro = $pipeiro->id;
        $endereco->estado = $request->estadores;
        $this->salvarArquivo($request, $endereco, "comprovanteresidencia", $pipeiro->cpf, "cadastro");
        $endereco->save();

        $veiculo = veiculo::firstOrNew(['id_pipeiro' => $pipeiro->id]);
        $veiculo->fill($request->all());
        $this->salvarArquivo($request, $veiculo, "doc_crlv", $pipeiro->cpf, "veiculo");
        $this->salvarArquivo($request, $veiculo, "doc_lav", $pipeiro->cpf, "veiculo");
        $this->salvarArquivo($request, $veiculo, "veiculo_img", $pipeiro->cpf, "veiculo");
        $this->salvarArquivo($request, $veiculo, "doc_cl", $pipeiro->cpf, "veiculo");
        $veiculo->save();

        $credenciamento = credenciamento::firstOrNew(['id_pipeiro' => $pipeiro->id]);
        $credenciamento->fill($request->all());
        $credenciamento->id_pipeiro = $pipeiro->id;
        $credenciamento->id_veiculo = $veiculo->id;
        $credenciamento->id_municipio = $request->municipio;
        $credenciamento->id_estado = $request->estado;
        // dd($credenciamento, $credenciamentoEmpresa);
        $credenciamento->id_edital = $credenciamentoEmpresa->id_edital;
        $credenciamento->status = 2;
        $this->salvarArquivo($request, $credenciamento, "doc_reqcred", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cico", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cicips", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cqe", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cqsm", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_sicaf", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_ciscc", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cndf", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cnde", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cndm", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cidt", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_antt", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_lvs", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_drctvc", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_maed", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cnis", $pipeiro->cpf, "credenciamento");

        $credenciamento->save();
        $pendencias = CredenciamentoController::checarPendencias($pipeiro->id);
        if (count($pendencias) > 0) {
            $credenciamento->status = 99;
            $mensagem = "Credenciamento salvo com sucesso. Porém há pendências a resolver.";
        } else if (count($pendencias) == 0) {
            $credenciamento->status = 3;
            $mensagem = "Credenciamento salvo com sucesso. Encaminhado para Análise.";
        }
        $credenciamento->save();
        return redirect()->route('empresa.editmotorista', $pipeiro->id)->with('success', $mensagem);
    }

    public function salvarmotorista(Request $request)
    {
        $this->credenciarPipeiro($request);
        return redirect()->route('empresa.motoristas');
    }

    public function pendenciasmotorista($id)
    {
        $pipeiro = Pipeiro_user::find($id);
        $pendencias = CredenciamentoController::checarPendenciasEmpresa(Auth('empresa')->user()->id);
        $pendenciasmotorista = CredenciamentoController::checarPendenciasPipeiroEmpresa($id);
        return view("empresa.pendenciasmotorista", compact("pipeiro", "pendenciasmotorista", 'pendencias'));
    }

    public function sanarpendenciasmotorista(Request $request)
    {
        // dd($request->all());
        $pipeiro = Pipeiro_user::find($request->id);
        // dd($request->all(), $pipeiro);
        $this->salvarArquivo($request, $pipeiro, "cnhfrente", $pipeiro->cpf, "cadastro");
        $pipeiro->save();

        if ($endereco = endereco::where("id_pipeiro", $pipeiro->id)->first()) {
            $this->salvarArquivo($request, $endereco, "comprovanteresidencia", $pipeiro->cpf, "cadastro");
            $endereco->save();
        }


        if ($veiculo = veiculo::where("id_pipeiro", $pipeiro->id)->first()) {
            $this->salvarArquivo($request, $veiculo, "doc_crlv", $pipeiro->cpf, "veiculo");
            $this->salvarArquivo($request, $veiculo, "doc_lav", $pipeiro->cpf, "veiculo");
            $this->salvarArquivo($request, $veiculo, "veiculo_img", $pipeiro->cpf, "veiculo");
            $this->salvarArquivo($request, $veiculo, "doc_cl", $pipeiro->cpf, "veiculo");
            $veiculo->save();
        }


        if ($banco = dadosbancarios::where("id_pipeiro", $pipeiro->id)->first()) {
            $this->salvarArquivo($request, $banco, "doc_comprovante", $pipeiro->cpf, "cadastro");
            $banco->save();
        }


        if ($credenciamento = credenciamento::where("id_pipeiro", $pipeiro->id)->first()) {
            $this->salvarArquivo($request, $credenciamento, "doc_reqcred", $pipeiro->cpf, "credenciamento");
            $this->salvarArquivo($request, $credenciamento, "doc_drctvc", $pipeiro->cpf, "credenciamento");
            $this->salvarArquivo($request, $credenciamento, "doc_cicips", $pipeiro->cpf, "credenciamento");
            $this->salvarArquivo($request, $credenciamento, "doc_antt", $pipeiro->cpf, "credenciamento");
            $this->salvarArquivo($request, $credenciamento, "doc_lvs", $pipeiro->cpf, "credenciamento");

            // $this->salvarArquivo($request, $credenciamento, "doc_cico", $pipeiro->cpf, "credenciamento");
            // $this->salvarArquivo($request, $credenciamento, "doc_cqe", $pipeiro->cpf, "credenciamento");
            // $this->salvarArquivo($request, $credenciamento, "doc_cqsm", $pipeiro->cpf, "credenciamento");
            // $this->salvarArquivo($request, $credenciamento, "doc_sicaf", $pipeiro->cpf, "credenciamento");
            // $this->salvarArquivo($request, $credenciamento, "doc_ciscc", $pipeiro->cpf, "credenciamento");
            //$this->salvarArquivo($request, $credenciamento, "doc_ciem", $pipeiro->cpf, "credenciamento");
            // $this->salvarArquivo($request, $credenciamento, "doc_cndf", $pipeiro->cpf, "credenciamento");
            // $this->salvarArquivo($request, $credenciamento, "doc_cnde", $pipeiro->cpf, "credenciamento");
            // $this->salvarArquivo($request, $credenciamento, "doc_cndm", $pipeiro->cpf, "credenciamento");
            // $this->salvarArquivo($request, $credenciamento, "doc_cidt", $pipeiro->cpf, "credenciamento");
            //$this->salvarArquivo($request, $credenciamento, "doc_act", $pipeiro->cpf, "credenciamento");
            // $this->salvarArquivo($request, $credenciamento, "doc_maed", $pipeiro->cpf, "credenciamento");
            // $this->salvarArquivo($request, $credenciamento, "doc_cnis", $pipeiro->cpf, "credenciamento");
            $credenciamento->save();
        }

        return redirect()->route("empresa.motoristas");
    }
}
