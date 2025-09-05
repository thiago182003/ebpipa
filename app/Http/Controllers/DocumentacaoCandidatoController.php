<?php

namespace App\Http\Controllers;

use App\Models\Documentacao;
use App\Models\DocumentacaoCandidato;
use App\Models\DocumentacaoEdital;
use App\Models\Edital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Do_;

class DocumentacaoCandidatoController extends Controller
{
    //

    public function documentacoes(){
        $id = Auth::guard('pipeiro')->user()->id ?? Auth::guard('empresa')->user()->id ?? 0;
        $tipo = Auth::guard('pipeiro')->user() ? 'pipeiro' : 'empresa';
        if($tipo == "pipeiro"){
            $pendencias = CredenciamentoController::checarPendencias(Auth::guard('pipeiro')->user()->id);
            $menu = 'layouts.default';
        }else{
            $pendencias = CredenciamentoController::checarPendenciasEmpresa(Auth::guard('empresa')->user()->id);
            $menu = 'layouts.defaultemp';
        }
        $creds = CredenciamentoController::getCredenciamentos($tipo);
        return view('docextra.documentos',compact('creds','pendencias','menu'));
    }

    public function buscar(Request $request){
        $id = Auth::guard('pipeiro')->user()->id ?? Auth::guard('empresa')->user()->id ?? 0;
        $tipo = Auth::guard('pipeiro')->user() ? 'pipeiro' : 'empresa';
        $id_edital = $request->id;
        $pessoa = Auth::guard('pipeiro')->user() ? 'pessoa_fisica' : 'pessoa_juridica';
        $docs = DocumentacaoEdital::whereHas('documento',function($query) use ($pessoa){
            $query->where($pessoa,'1');
        })->with('documento')->where('edital_id',$id_edital)->get();
        foreach ($docs as $d) {
            $d->doccandidato = DocumentacaoCandidato::where(['edital_id'=>$id_edital,'candidato_type'=>$tipo,"candidato_id"=> $id,'documentacao_id' => $d->documento->id])->first();
        }
        return $docs;
    }

    public function salvar(Request $request){
        // dd($request->all());
        $id = Auth::guard('pipeiro')->user()->id ?? Auth::guard('empresa')->user()->id ?? 0;
        $tipo = Auth::guard('pipeiro')->user() ? 'pipeiro' : 'empresa';
        $chave = Auth::guard('pipeiro')->user() ? Auth::guard('pipeiro')->user()->cpf : Auth::guard('empresa')->user()->cnpj;
        $arquivos = $request->allFiles();
        foreach($arquivos as $name => $file){
            $documento = DocumentacaoCandidato::where(['edital_id'=>$request->id_edital,'documentacao_id'=>$name,'candidato_id'=>$id])->first();
            if($documento){
                dd($documento);
            }else{
                $documento = new DocumentacaoCandidato();
                $documento->candidato_id = $id;
                $documento->candidato_type = $tipo;
                $documento->edital_id = $request->id_edital;
                $documento->documentacao_id = $name;
                $edital = Edital::find($request->id_edital);
                //salva o arquivo
                $extension = strtolower($file->getClientOriginalExtension());
                if ($extension === 'pdf') {             
                    if($file->getSize() > 5242880){
                        $documento->arquivo = "";
                        $documento->status = "99";
                        $documento->observacoes = "O arquivo é maior que 5mb";
                    }else{
                        $edital->nome = str_replace(" ","",$edital->nome);
                        $pastaEdital = $edital->id . $edital->nome;
                        $caracteres_para_remover = array(".", ",", "-", "/");
                        $chave = str_replace($caracteres_para_remover, "", $chave);
                        $documento->arquivo = $file->store($pastaEdital . '/' . $chave . '/documentosextras');
                        $documento->status = 2;
                        $documento->observacoes = '';       
                    }
                    
                } else {
                    $documento->arquivo = "";
                    $documento->status = "99";
                    $documento->observacoes = "O arquivo não era um PDF";
                }
                $documento->save();
                
            }
        }
        return redirect()->route('documentacoes.extra');

    }

    public function removerdocextra(Request $request){
        $id_doc = $request->id_doc;
        $id_edital = $id_edital = $request->id;
        $id = Auth::guard('pipeiro')->user()->id ?? Auth::guard('empresa')->user()->id ?? 0;
        $tipo = Auth::guard('pipeiro')->user() ? 'pipeiro' : 'empresa';
        $doccandidato = DocumentacaoCandidato::where(['edital_id'=>$id_edital,'candidato_type'=>$tipo,"candidato_id"=> $id,'documentacao_id' => $id_doc])->first();
        
    }

    public function associar(){
        $editais = EditalController::editaisOM();
        // dd($editais);
        $docs = DocumentacaoCandidato::all();
        return view("documento.associar",compact('docs','editais'));
    }

    public static function salvarArquivo($request, &$object, $arquivo, $chave, $pasta,$edital = null){
        
        if ($request->hasFile($arquivo)) {
            $file = $request->file($arquivo);
            if ($object[$arquivo] && Storage::exists($object[$arquivo])) {
                Storage::delete($object[$arquivo]);
            }
            $extension = strtolower($file->getClientOriginalExtension());
            if ($extension === 'pdf') {             
                if($file->getSize() > 5242880){
                    $object[$arquivo] = "";
                    $object[$arquivo . "_status"] = "99";
                    $object[$arquivo . "_obs"] = "O arquivo é maior que 5mb";
                }else{
                    $edital->nome = str_replace(" ","",$edital->nome);
                    $pastaEdital = $edital->id . $edital->nome;
                    $caracteres_para_remover = array(".", ",", "-", "/");
                    $chave = str_replace($caracteres_para_remover, "", $chave);
                    $caminho = $file->store($pastaEdital . '/' . $chave . '/' . $pasta);
                }
                
            } else {
                $object[$arquivo] = "";
                $object[$arquivo . "_status"] = "99";
                $object[$arquivo . "_obs"] = "O arquivo não era um PDF";
            }
        }
    }
}
