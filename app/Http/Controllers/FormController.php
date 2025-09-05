<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Pipeiro_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function show()
    {
        // Exibe a view do formulário
        return view('forms');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'relato' => 'required|string|max:1500',
            'estado' => 'required|integer',
            'municipio' => 'required|integer',
            'tipo_solicitacao' => 'required|string',
            'anexos.*' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'cpf' => 'nullable|string',
            'email' => 'nullable|email',
            'nome' => 'nullable|string',
            'telefone' => 'nullable|string',
            'tipo_requerente' => 'nullable|string'
        ]);

        $payload = $request->only(['relato','estado','municipio','tipo_solicitacao','cpf','email','nome','telefone','tipo_requerente']);
        $payload['anonimo'] = empty($payload['cpf']);
        $payload['created_at'] = now()->toDateTimeString();

        // Gerar protocolo sequencial baseado no ano (ex: 2025001)
        $year = now()->format('Y');
        $counterDir = storage_path('app/forms');
        if (!file_exists($counterDir)) {
            mkdir($counterDir, 0755, true);
        }
        $counterFile = $counterDir . "/protocol_{$year}.txt";

        $seq = 1;
        $fp = @fopen($counterFile, 'c+'); // cria se não existir
        if ($fp !== false) {
            if (flock($fp, LOCK_EX)) {
                // ler existente
                $contents = stream_get_contents($fp);
                $last = intval(trim($contents));
                $seq = $last + 1;
                // gravar novo valor
                rewind($fp);
                ftruncate($fp, 0);
                fwrite($fp, (string) $seq);
                fflush($fp);
                flock($fp, LOCK_UN);
            }
            fclose($fp);
        }

        $protocol = $year . sprintf('%03d', $seq);
        $payload['protocolo'] = $protocol;

        // salvar anexos
        $savedFiles = [];
        if ($request->hasFile('anexos')) {
            foreach ($request->file('anexos') as $f) {
                if ($f->isValid()) {
                    $name = Str::random(8) . '_' . preg_replace('/[^A-Za-z0-9\.\-_]/', '_', $f->getClientOriginalName());
                    $path = $f->storeAs('public/forms/anexos', $name);
                    $savedFiles[] = Storage::url($path);
                }
            }
        }

        $payload['anexos'] = $savedFiles;

        // salvar JSON com os dados
        $filename = 'forms/' . now()->format('Ymd_His') . '_' . Str::random(6) . '.json';
        Storage::disk('public')->put($filename, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // retornar redirect com protocolo na sessão para exibição ao usuário
    return redirect()->back()->with('success', 'Solicitação enviada com sucesso.')->with('protocolo', $protocol);
    }

    public function checkCpf(Request $request)
    {
        $cpf = preg_replace('/[^0-9]/', '', $request->input('cpf'));
        if (!$cpf) {
            return response()->json(['found' => false]);
        }

    // Normaliza a coluna cpf removendo pontos, traços e espaços para comparar apenas dígitos
    // Isso cobre casos onde o CPF está armazenado formatado no banco (ex: 000.000.000-00)
    $exists = Pipeiro_user::whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' ', ''), '/', '') = ?", [$cpf])->exists();

    return response()->json(['found' => (bool) $exists]);
    }

    public function estados()
    {
        $estados = Estado::select('id','nome','sigla')->whereIn('sigla',['PE','AL'])->get();
        return response()->json($estados);
    }

    public function municipios($estado_id)
    {
        $municipios = Municipio::where('id_estado', $estado_id)->select('id','nome')->orderBy('nome')->get();
        return response()->json($municipios);
    }
}
