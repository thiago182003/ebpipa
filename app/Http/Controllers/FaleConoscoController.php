<?php

namespace App\Http\Controllers;

use App\Models\faleConosco;
use Illuminate\Http\Request;

class FaleConoscoController extends Controller
{
    //
    public function enviar(Request $request)
    {
        $autor = Auth("pipeiro")->user();
        // dd($request->all());
        $fale = new faleConosco();
        $fale->id_user = $autor->id;
        $fale->nome = $autor->nome;
        $fale->email = $autor->email;
        $fale->assunto = $request->assunto;
        $fale->mensagem = $request->mensagem;
        if ($request->hasFile('anexo')) {
            $file = $request->file('anexo');
            $caminho = $file->store('anexo/faleconosco');
            $fale->imagem = $caminho;
        }
        $fale->save();
    }
    public function pagina()
    {
        $layout = "";
        if (Auth('pipeiro')->user()) {
            $layout = "layouts.default";
        } else {
            $layout = "layouts.defaultemp";
        }
        return view("faleconosco", compact('layout'));
    }
}
