<?php

namespace App\Http\Controllers;

use App\Http\Requests\PipeiroCadastrarFormRequest;
use App\Models\credenciamento;
use App\Models\dadosbancarios;
use App\Models\Empresa_user;
use App\Models\endereco;
use App\Models\Pipeiro_user;
use App\Models\veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login()
    {
        return view("login.login");
    }

    public function cadastro()
    {
        return view("login.cadastro");
    }

    public function logar(Request $request)
    {
        // dd($request->all());
        $tipo = $request->radio_pessoa;
        if ($tipo == "fisica") {
            $request->validate([
                'cpf' => ['required'],
                'password' => ['required']
            ], [
                'cpf.required'
            ]);

            $credentials = $request->only('cpf', 'password');

            if (!$this->validarcpf($request->cpf)) {
                return back()->withErrors([
                    'error' => 'Cpf Inválido.'
                ])->onlyInput('cpf');
            }
            

            $log = Auth::guard('pipeiro')->attempt($credentials, false);
            if ($log) {
                $request->session()->regenerate();
                if(Auth::guard('pipeiro')->user()->mudasenha == 1){
                    return redirect()->route('pipeiro.alterasenha');
                }
                return redirect()->route('pipeiro.dashboard');
            }

            return back()->withErrors([
                'error' => 'Cpf ou Senha Incorreto.'
            ])->onlyInput('cpf');
        } else {
            $request->validate([
                'cnpj' => ['required'],
                'password' => ['required']
            ], [
                'cnpj.required'
            ]);


            $credentials = $request->only('cnpj', 'password');

            if (!$this->validar_cnpj($request->cnpj)) {
                return back()->withErrors([
                    'error' => 'CNPJ Inválido.'
                ])->onlyInput('cnpj');
            }

            $log = Auth::guard('empresa')->attempt($credentials, false);
            if ($log) {
                $request->session()->regenerate();
                if(Auth::guard('empresa')->user()->mudasenha == 1){
                    return redirect()->route('empresa.alterasenha');
                }
                return redirect()->route('empresa.dashboard');
            }
           

            return back()->withErrors([
                'error' => 'CNPJ ou Senha Incorreto.'
            ])->onlyInput('cnpj');
        }
    }


    function validarSenhaForte($senha)
    {
        // Pelo menos 8 caracteres
        if (strlen($senha) < 8) {
            return false;
        }

        // Pelo menos uma letra maiúscula
        if (!preg_match('/[A-Z]/', $senha)) {
            return false;
        }

        // Pelo menos uma letra minúscula
        if (!preg_match('/[a-z]/', $senha)) {
            return false;
        }

        // Pelo menos um número
        if (!preg_match('/\d/', $senha)) {
            return false;
        }

        // Pelo menos um caractere especial (não alfanumérico)
        if (!preg_match('/[^a-zA-Z\d]/', $senha)) {
            return false;
        }

        // Senha válida
        return true;
    }


    public function cadastrar(Request $request)
    {

        // dd($request->all());
        if (!$this->validarSenhaForte($request->password)) {
            return back()->withErrors([
                'error' => 'A senha deve ser forte.'
            ]);
        }

        $tipo = $request->radio_pessoa;
        if ($tipo == "fisica") {
            $request->validate([
                'cpf' => ['required', 'unique:pipeiro_users'],
                'email' => ['required'],
                'nome' => ['required'],
                'password' => ['required']
            ]);
            $data = $request->all();
            if (!$this->validarcpf($data["cpf"])) {
                return back()->withErrors([
                    'error' => 'Cpf Inválido.'
                ])->onlyInput('cpf');
            }

            $data['password'] = bcrypt($request->password);

            if (Pipeiro_user::create($data)) {
                return redirect()->route('login.login')->with('mensagem', "Cadastrado com sucesso.");
            }

            return back()->withErrors([
                'error' => 'CPF ou Senha Incorreto.'
            ])->onlyInput('CPF');
        } else {
            $request->validate([
                'cnpj' => ['required', 'unique:empresa_users'],
                'email' => ['required'],
                'razaosocial' => ['required'],
                'password' => ['required']
            ]);
            $data = $request->all();
            if (!$this->validar_cnpj($data["cnpj"])) {
                return back()->withErrors([
                    'error' => 'cnpj Inválido.'
                ])->onlyInput('cnpj');
            }
            // dd($data);
            $data['password'] = bcrypt($request->password);

            if (Empresa_user::create($data)) {
                return redirect()->route('login.login')->with('mensagem', "Cadastrado com sucesso.");
            }

            return back()->withErrors([
                'error' => 'CNPJ ou Senha Incorreto.'
            ])->onlyInput('cnpj');
        }
    }

    // public function cadastrar(PipeiroCadastrarFormRequest $request)
    // {
    //     dd($request->all());
    //     $tipo = $request->radio_pessoa;
    //     if ($tipo == "fisica") {

    //         $data = $request->all();
    //         $data["cpf"] = preg_replace('/[^0-9]/', '', (string) $data["cpf"]);
    //         if (!$this->validarcpf($data["cpf"])) {
    //             return back()->withErrors([
    //                 'error' => 'Cpf Inválido.'
    //             ])->onlyInput('cpf');
    //         }

    //         $data['password'] = bcrypt($request->password);

    //         if (Pipeiro_user::create($data)) {
    //             return redirect()->route('login.login');
    //         }

    //         return back()->withErrors([
    //             'error' => 'CPF ou Senha Incorreto.'
    //         ])->onlyInput('CPF');
    //     } else {
    //         $data = $request->all();
    //         $data["cnpj"] = preg_replace('/[^0-9]/', '', (string) $data["cnpj"]);
    //         $request->validate([
    //             'cnpj' => ['required'],
    //             'password' => ['required']
    //         ], [
    //             'cnpj.required'
    //         ]);

    //         if (!$this->validar_cnpj($data["cnpj"])) {
    //             return back()->withErrors([
    //                 'error' => 'cnpj Inválido.'
    //             ])->onlyInput('cnpj');
    //         }
    //         // dd($data);
    //         $data['password'] = bcrypt($request->password);

    //         if (Empresa_user::create($data)) {
    //             return redirect()->route('login.login');
    //         }

    //         return back()->withErrors([
    //             'error' => 'CNPJ ou Senha Incorreto.'
    //         ])->onlyInput('cnpj');
    //     }
    // }


    function validar_cnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;

        // Verifica se todos os digitos são iguais
        // if (preg_match('/(\d)\1{13}/', $cnpj))
        //     return false;

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }

    static public function validarcpf($value)
    {
        $c = preg_replace('/\D/', '', $value);
        if (strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            return false;
        }
        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);
        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);
        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
        return true;
    }
}
