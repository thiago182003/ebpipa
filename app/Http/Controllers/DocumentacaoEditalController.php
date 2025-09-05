<?php

namespace App\Http\Controllers;

use App\Models\DocumentacaoEdital;
use Illuminate\Http\Request;

class DocumentacaoEditalController extends Controller
{
    //
    public function salvar(Request $request){
        $edital = $request->id_edital;
        $obrigatorios = $request->obrigatorio;
        
        foreach($request->adicionar as $docAdd){
            $doc = DocumentacaoEdital::firstOrNew(['edital_id' => $edital,'documentacao_id' => $docAdd]);
            $doc->is_obrigatorio = $obrigatorios ? in_array($docAdd,$obrigatorios) : 0;
            $doc->save();
        }
        return redirect()->back();
    }

    public function buscar(Request $request){
        $edital = $request->id;
        $docs = DocumentacaoEdital::where(['edital_id' => $edital])->get();
        return $docs;
    }

}