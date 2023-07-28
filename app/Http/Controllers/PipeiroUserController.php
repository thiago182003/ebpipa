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
use App\Models\Processo;
use App\Models\veiculo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PipeiroUserController extends Controller
{
    //

    public $estadocivil = [
        'Solteiro' => '1',
        'Casado' => '2',
        'União Estável' => '3',
        'Outro' => '4'
    ];

    public $raca = [
        'Amarelo' => '1',
        'Branco' => '2',
        'Indio' => '3',
        'Pardo' => '4',
        'Negro' => '5',
        'Outros' => '6',
    ];

    public $escolaridade = [
        'Ensino Fundamental' => '1',
        'Ensino Fundamental Incomleto' => '2',
        'Ensino Médio' => '3',
        'Ensino Médio Incompleto' => '4',
        'Ensino Superior' => '5',
        'Ensino Superior Incompleto' => '6',
        'Outro' => '7',
    ];

    public $genero = [
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

    public function credenciamento()
    {
        $pendencias = CredenciamentoController::checarPendencias(Auth::guard('pipeiro')->user()->id);

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

        $estados = Estado::where('id_om', 2)->get();
        $todosestados = Estado::all();
        $municipios = Municipio::all();
        $editais = Edital::all();
        $pipeiro = Auth('pipeiro')->user();
        $credenciamento = credenciamento::where("id_pipeiro", $pipeiro->id)->first();
        $processos = Processo::where('id_edital', $editais[0]->id)->get();
        $veiculo = veiculo::where('id_pipeiro', $pipeiro->id)->first();
        $dadosbancarios = dadosbancarios::where('id_pipeiro', $pipeiro->id)->first();
        $endereco = endereco::where('id_pipeiro', $pipeiro->id)->first();
        $bancos = DB::table('bancos')->get();
        return view('pipeiro.credenciamento', compact(
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
            'pendencias',
            'bancos',
            'todosestados'
        ));
    }

    public function credenciar(Request $request)
    {
        $pipeiro = Pipeiro_user::find($request->id);
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

        $banco = dadosbancarios::firstOrNew(['id_pipeiro' => $pipeiro->id]);
        $banco->fill($request->all());
        $banco->id_pipeiro = $pipeiro->id;
        $this->salvarArquivo($request, $banco, "doc_comprovante", $pipeiro->cpf, "cadastro");
        $banco->save();

        $credenciamento = credenciamento::firstOrNew(['id_pipeiro' => $pipeiro->id]);
        $credenciamento->fill($request->all());
        $credenciamento->id_pipeiro = $pipeiro->id;
        $credenciamento->id_veiculo = $veiculo->id;
        $credenciamento->id_municipio = $request->municipio;
        $credenciamento->id_estado = $request->estado;
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
        // dd("aqui");
        $this->salvarArquivo($request, $credenciamento, "doc_maed", $pipeiro->cpf, "credenciamento");
        // dd($credenciamento);
        $this->salvarArquivo($request, $credenciamento, "doc_cnis", $pipeiro->cpf, "credenciamento");
        // $credenciamento->save();

        $pendencias = CredenciamentoController::checarPendencias($pipeiro->id);
        if (count($pendencias) > 0) {
            $credenciamento->status = 99;
            $mensagem = "Credenciamento salvo com sucesso. Porém há pendências a resolver.";
        } else if (count($pendencias) == 0) {
            $credenciamento->status = 3;
            $mensagem = "Credenciamento salvo com sucesso. Encaminhado para Análise.";
        }
        $credenciamento->save();

        return redirect()->route('pipeiro.credenciamento')->with('success', $mensagem);
    }

    public function pendencias()
    {
        $pendencias = CredenciamentoController::checarPendencias(Auth::guard('pipeiro')->user()->id);
        return view('pipeiro.pendencias', compact('pendencias'));
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
            case "pipeiro":
                $class = Pipeiro_user::find(auth('pipeiro')->user()->id);
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

    public function redcredpdf()
    {
        $pipeiro = Pipeiro_user::find(Auth::guard('pipeiro')->user()->id);
        $credenciamento = credenciamento::where("id_pipeiro", $pipeiro->id)->first();
        $municipio = Municipio::find($credenciamento->id_municipio);
        $veiculo = veiculo::where('id_pipeiro', $pipeiro->id)->first();
        $dadosbancarios = dadosbancarios::where('id_pipeiro', $pipeiro->id)->first();
        $endereco = endereco::where('id_pipeiro', $pipeiro->id)->first();

        return view("requerimentos.credenciamento", compact('pipeiro', 'credenciamento', 'municipio', 'endereco', 'veiculo', 'dadosbancarios'));
    }

    public function sanarpendencias(Request $request)
    {

        $pipeiro = Pipeiro_user::find(Auth::guard('pipeiro')->user()->id);
        $this->salvarArquivo($request, $pipeiro, "cnhfrente", $pipeiro->cpf, "cadastro");
        $pipeiro->save();

        $endereco = endereco::where("id_pipeiro", $pipeiro->id)->first();
        $this->salvarArquivo($request, $endereco, "comprovanteresidencia", $pipeiro->cpf, "cadastro");
        $endereco->save();

        $veiculo = veiculo::where("id_pipeiro", $pipeiro->id)->first();
        $this->salvarArquivo($request, $veiculo, "doc_crlv", $pipeiro->cpf, "veiculo");
        $this->salvarArquivo($request, $veiculo, "doc_lav", $pipeiro->cpf, "veiculo");
        $this->salvarArquivo($request, $veiculo, "veiculo_img", $pipeiro->cpf, "veiculo");
        $this->salvarArquivo($request, $veiculo, "doc_cl", $pipeiro->cpf, "veiculo");
        $veiculo->save();

        $banco = dadosbancarios::where("id_pipeiro", $pipeiro->id)->first();
        $this->salvarArquivo($request, $banco, "doc_comprovante", $pipeiro->cpf, "cadastro");
        $banco->save();

        $credenciamento = credenciamento::where("id_pipeiro", $pipeiro->id)->first();
        $this->salvarArquivo($request, $credenciamento, "doc_reqcred", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cico", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cicips", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cqe", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cqsm", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_sicaf", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_ciscc", $pipeiro->cpf, "credenciamento");
        //$this->salvarArquivo($request, $credenciamento, "doc_ciem", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cndf", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cnde", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cndm", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cidt", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_antt", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_lvs", $pipeiro->cpf, "credenciamento");
        //$this->salvarArquivo($request, $credenciamento, "doc_act", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_drctvc", $pipeiro->cpf, "credenciamento");

        $this->salvarArquivo($request, $credenciamento, "doc_maed", $pipeiro->cpf, "credenciamento");
        $this->salvarArquivo($request, $credenciamento, "doc_cnis", $pipeiro->cpf, "credenciamento");
        $credenciamento->save();

        $pendencias = CredenciamentoController::checarPendencias($pipeiro->id);
        if (count($pendencias) > 0) {
            if ($credenciamento->status != 2) {
                $credenciamento->status = 99;
            }
            $mensagem = "Credenciamento salvo com sucesso. Porém há pendências a resolver.";
        } else if (count($pendencias) == 0) {
            $credenciamento->status = 3;
            $mensagem = "Credenciamento salvo com sucesso. Encaminhado para Análise.";
        }
        $credenciamento->save();
        return redirect()->route('pipeiro.pendencias')->with('success', $mensagem);
    }


    public function salvarArquivo($request, &$object, $arquivo, $chave, $pasta)
    {
        if ($request->hasFile($arquivo)) {
            // dd("aqui1");
            $file = $request->file($arquivo);
            // dd($file, $arquivo);
            if ($object[$arquivo] && Storage::exists($object[$arquivo])) {
                Storage::delete($object[$arquivo]);
            }
            $extension = strtolower($file->getClientOriginalExtension());
            if ($extension === 'pdf') {
                // dd("aqui2");
                $caminho = $file->store($chave . '/' . $pasta);
                $object[$arquivo] = $caminho;
                $object[$arquivo . "_status"] = "1";
                $object[$arquivo . "_obs"] = "";
            } else {

                $object[$arquivo] = "";
                $object[$arquivo . "_status"] = "99";
                $object[$arquivo . "_obs"] = "O arquivo não era um PDF";
            }
        }
    }
}
