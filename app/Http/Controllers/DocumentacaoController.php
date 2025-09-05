<?php

namespace App\Http\Controllers;

use App\Models\Documentacao;
use App\Models\Edital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentacaoController extends Controller
{
    //
    public function documentos(){
        $docs = Documentacao::all();
        return view("documento.documentos",compact('docs'));
    }

    public function associar(){
        $editais = EditalController::editaisOM();
        // dd($editais);
        $docs = Documentacao::all();
        return view("documento.associar",compact('docs','editais'));
    }

    public function novo($id = null){
        if(is_null($id)){
            return view("documento.novo");
        }else{
            $documento = Documentacao::find($id);
            return view("documento.novo",compact('documento'));
        }
    }

    public function salvar(Request $request){
        // dd($request->all());
        // dd($request->hasFile("link"));
        if(is_null($request->id)){
            $documento = new Documentacao;
        }else{
            $documento = Documentacao::find($request->id);
        }
        $documento->nome = $request->nome;
        $documento->descricao = $request->descricao;
        $documento->pessoa_fisica = $request->pipeiro ? true : false;
        $documento->pessoa_juridica = $request->empresa ? true : false;
        $documento->is_obrigatorio = false;
        $this->salvarArquivo($request,'link',$documento);
        // dd($documento);
        $documento->save();
        return redirect()->route('op.documentos');
    }

    public function deletarArquivo(Request $request){
        $documento = Documentacao::find($request->id);
        if (Storage::exists($documento['link'])) {
            Storage::delete($documento['link']);
        }
        $documento['link'] = '';
        $documento->save();
    }

    public function deletarDocumento(Request $request){
        $documento = Documentacao::find($request->id);
        if (Storage::exists($documento['link'])) {
            Storage::delete($documento['link']);
        }
        $documento->delete();
    }

    public function salvarArquivo($request,$arquivo,&$object)
    {
        // dd($request->hasFile($arquivo));
        if ($request->hasFile($arquivo)) {
            $file = $request->file($arquivo);
            // dd($file);
            if ($object[$arquivo] && Storage::exists($object[$arquivo])) {
                Storage::delete($object[$arquivo]);
            }
            $extension = strtolower($file->getClientOriginalExtension());
            if ($extension === 'doc' || $extension === 'docx' || $extension === 'odt' || $extension === 'ods' || $extension === 'pdf') {
                if($file->getSize() > 5242880){
                    $object[$arquivo] = "";
                }else{
                    $caminho = $file->store('documentos');
                    $object[$arquivo] = $caminho;
                    // dd($chave,$caminho);
                }
                
            } else {
                $object[$arquivo] = "";
            }
        }
    }
}
