<?php

namespace App\Http\Controllers;

use App\Models\credenciamento;
use App\Models\dadosbancarios;
use App\Models\Edital;
use App\Models\Empresa_user;
use App\Models\endereco;
use App\Models\Estado;
use App\Models\faleConosco;
use App\Models\Municipio;
use App\Models\Operador_user;
use App\Models\Pipeiro_user;
use App\Models\veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $request["cpf"] = preg_replace('/[^0-9]/', '', (string) $request["cpf"]);
        $credentials = $request->only('cpf', 'password');

        if (!LoginController::validarcpf($request->cpf)) {
            return back()->withErrors([
                'error' => 'Cpf Inválido.'
            ])->onlyInput('cpf');
        }
        // dd($credentials);
        $log = Auth::guard('operador')->attempt($credentials, false);
        // dd($log);
        if ($log) {
            $request->session()->regenerate();
            return redirect()->route('operador.dashboard');
        }

        return back()->withErrors([
            'error' => 'Cpf ou Senha Incorreto.'
        ])->onlyInput('cpf');
    }

    public function dashboard()
    {
        return view('operador.dashboard');
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
        // dd($pip);
        $pip->fill($request->all());

        $pip->update();
        dd($pip);
    }

    public function credenciamentos()
    {

        $creds = credenciamento::where('status', '!=', "99")->whereNotNull("id_pipeiro")->whereNull('id_empresa')->get();

        foreach ($creds as $cred) {
            $cred->pipeiro = Pipeiro_user::find($cred->id_pipeiro);
        }
        return view('operador.credenciamentos', compact('creds'));
    }

    public function pendentes()
    {

        $creds = credenciamento::where('status', "99")->get();
        foreach ($creds as $cred) {
            // dd($cred);
            if (!is_null($cred->id_pipeiro)) {

                $cred->pipeiro = Pipeiro_user::find($cred->id_pipeiro);
            } elseif (!is_null($cred->id_empresa)) {

                $cred->empresa = Empresa_user::find($cred->id_empresa);
            }
        }
        return view('operador.pendentes', compact('creds'));
    }

    public function faleconosco()
    {
        $faleconosco = faleConosco::all();
        return view("operador.faleconosco", compact('faleconosco'));
    }

    public function empresas()
    {

        $creds = credenciamento::where('status', '!=', "99")->where("id_empresa", '!=', null)->get();

        foreach ($creds as $cred) {
            $cred->empresa = Empresa_user::find($cred->id_empresa);
        }
        return view('operador.empresas', compact('creds'));
    }

    public function cred($cred)
    {

        $credenciamento = credenciamento::find($cred);

        if (is_null($credenciamento->id_empresa)) {
            $veiculo = veiculo::find($credenciamento->id_veiculo);
            $pipeiro = Pipeiro_user::find($credenciamento->id_pipeiro);
            $edital = Edital::find($credenciamento->id_edital);
            $dadosbancarios = dadosbancarios::where('id_pipeiro', '=', $pipeiro->id)->first();
            $estado = Estado::find($credenciamento->id_estado);
            $municipio = Municipio::find($credenciamento->id_municipio);
            $endereco = endereco::where("id_pipeiro", "=", $pipeiro->id)->first();

            // dd($endereco);
            switch ($pipeiro->escolaridade) {
                case "1":
                    $pipeiro->escolaridade = "Ensino Fundamental";
                    break;
                case "2":
                    $pipeiro->escolaridade = "Ensino Fundamental Incomleto";
                    break;
                case "3":
                    $pipeiro->escolaridade = "Ensino Médio";
                    break;
                case "4":
                    $pipeiro->escolaridade = "Ensino Médio Incompleto";
                    break;
                case "5":
                    $pipeiro->escolaridade = "Ensino Superior";
                    break;
                case "6":
                    $pipeiro->escolaridade = "Ensino Superior Incompleto";
                    break;
                case "7":
                    $pipeiro->escolaridade = "Outro";
                    break;
            }
            switch ($pipeiro->estadocivil) {
                case "1":
                    $pipeiro->estadocivil = "Solteiro";
                    break;
                case "2":
                    $pipeiro->estadocivil = "Casado";
                    break;
                case "3":
                    $pipeiro->estadocivil = "União Estável";
                    break;
                case "":
                    $pipeiro->estadocivil =  "Outro";
                    break;
            }
            switch ($pipeiro->raca) {
                case "1":
                    $pipeiro->raca = "Amarelo";
                    break;
                case "2":
                    $pipeiro->raca = "Branco";
                    break;
                case "3":
                    $pipeiro->raca = "Indio";
                    break;
                case "4":
                    $pipeiro->raca = "Pardo";
                    break;
                case "5":
                    $pipeiro->raca = "Negro";
                    break;
                case "6":
                    $pipeiro->raca = "Outros";
                    break;
            }
            // dd($credenciamento);
            return view("operador.cred", compact('credenciamento', 'veiculo', 'pipeiro', 'edital', 'dadosbancarios', 'estado', 'municipio', 'endereco'));
        } else {
            // dd("aqyu");
            $veiculo = veiculo::find($credenciamento->id_veiculo);
            $empresa = Empresa_user::find($credenciamento->id_empresa);
            $edital = Edital::find($credenciamento->id_edital);
            $dadosbancarios = dadosbancarios::where('id_empresa', $empresa->id)->first();
            $estado = Estado::find($credenciamento->id_estado);
            $municipio = Municipio::find($credenciamento->id_municipio);
            $endereco = endereco::where("id_empresa", $empresa->id)->first();
            // dd($credenciamento, $edital, $estado);
            return view("operador.credemp", compact('credenciamento', 'veiculo', 'empresa', 'edital', 'dadosbancarios', 'estado', 'municipio', 'endereco'));
        }
    }

    public function aprovar($cred)
    {
        $credenciamento = credenciamento::find($cred);
        $credenciamento->status = 1;
        $credenciamento->save();
        return redirect()->route('operador.credenciamentos')->with('success', "Aprovado com sucesso");
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
                $class = Pipeiro_user::find(auth('pipeiro')->user()->id);
                break;
            case "veiculo":
                $class = veiculo::find($request->id);
        }
        $class["$request->arquivo" . "_status"] = $request->status;
        if ($request->status == '99') {
            $credenciamento->status = 2;
        }
        $credenciamento->save();
        $class["$request->arquivo" . "_obs"] = $request->obs ? $request->obs : "";
        $class->save();
    }
}
