<?php

namespace App\Http\Controllers;

use App\Models\Anexo;
use App\Models\Om;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnexoController extends Controller
{
    //
    public function anexos(){
    
        // $oms = Om::all();
        // if(Auth::guard('operador')->user()->nivel == 0){
        //     $anexos = Anexo::all();
        // }else{
            $om = Auth::guard('operador')->user()->id_om;
            // dd($om);
            $anexos = Anexo::where('id_om',$om)->first(); 
            // dd($anexos); 
        // }

        return view('anexos.anexos',compact('anexos'));
    }

    public function salvar(Request $request){
        $om = Auth::guard('operador')->user()->id_om;
        $anexos = Anexo::where('id_om',$om)->firstOrNew();
        $anexos->id_om = $om;
        $this->salvarArquivo($request, $anexos, "requerimento_credenciamento", $om, "anexos");
        $this->salvarArquivo($request, $anexos, "conhecimento_das_informacoes", $om, "anexos");
        $this->salvarArquivo($request, $anexos, "condicao_do_veiculo", $om, "anexos");
        $this->salvarArquivo($request, $anexos, "exposicao_dados", $om, "anexos");
        $this->salvarArquivo($request, $anexos, "trabalho_de_menor", $om, "anexos");
        $anexos->save();
        return redirect()->route('op.anexos',compact('anexos'));
    }

    public function salvarArquivo($request, &$object, $arquivo, $chave, $pasta)
    {
        // dd($arquivo);;
        if ($request->hasFile($arquivo)) {
            $file = $request->file($arquivo);
            // dd($file);
            if ($object[$arquivo] && Storage::exists($object[$arquivo])) {
                Storage::delete($object[$arquivo]);
            }
            $extension = strtolower($file->getClientOriginalExtension());
            if ($extension === 'doc' || $extension === 'docx' || $extension === 'odt' || $extension === 'ods') {
                if($file->getSize() > 5242880){
                    $object[$arquivo] = "";
                }else{
                    $caracteres_para_remover = array(".", ",", "-", "/");
                    $chave = str_replace($caracteres_para_remover, "", $chave);
                    $caminho = $file->store($chave . '/' . $pasta);
                    $object[$arquivo] = $caminho;
                    // dd($chave,$caminho);
                }
                
            } else {
                $object[$arquivo] = "";
            }
        }
    }

    public function deletarArquivo(Request $request){
        $arquivo = $request->arquivo;
        $om = Auth::guard('operador')->user()->id_om;
        $anexos = Anexo::where('id_om',$om)->first();
        if (Storage::exists($anexos[$arquivo])) {
            Storage::delete($anexos[$arquivo]);
        }
        $anexos[$arquivo] = '';
        $anexos->save();
    }

}
