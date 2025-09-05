<?php

namespace App\Http\Controllers;

use App\Models\Edital;
use App\Models\Om;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditalController extends Controller
{
    //
    public function editais()
    {
        $nivel = Auth::guard('operador')->user()->nivel;
        if($nivel == 0){
            $editais = Edital::all();
        }else{
            $editais = Edital::where('id_om',Auth::guard('operador')->user()->id_om)->get();
        }$nivel = Auth::guard('operador')->user()->nivel;

        foreach($editais as $ed){
            $ed->om = Om::find($ed->id_om);
        }
        return view("edital.editais",compact('editais'));
    }

    public function novo()
    {
        $oms = OmController::buscarOms();
        return view("edital.novo",compact('oms'));
    }

    public function editar(Request $request)
    {
        $edital = Edital::find($request->id);
        $oms = OmController::buscarOms();
        return view("edital.novo",compact('edital','oms'));
    }

    public function deletar(Request $request){
        $id = $request->id;
        $edital = Edital::find($id);
        if (Storage::exists($edital->documento)) {
            Storage::delete($edital->documento);
        }
        $edital->delete();
    }

    public function deletarArquivo(Request $request){
        $id = $request->id;
        $edital = Edital::find($id);
        if (Storage::exists($edital->documento)) {
            Storage::delete($edital->documento);
        }
        $edital->documento = '';
        $edital->save();
    }

    public function salvar(Request $request)
    {
        if($request->nome === null){
            return redirect()->back();
        }
        $edital = Edital::firstOrNew(['id' => $request->id]);
        $edital->fill($request->all());
        
        $editais = Edital::all();
        $arquivo = 'documento';
        if ($request->hasFile($arquivo)) {
            // dd("aqui1");
            $file = $request->file($arquivo);
            // dd($file, $arquivo);
            if ($edital[$arquivo] && Storage::exists($edital[$arquivo])) {
                Storage::delete($edital[$arquivo]);
            }
            $extension = strtolower($file->getClientOriginalExtension());
            if ($extension === 'pdf') {
                // dd("aqui2");
                $caminho = $file->store('editais');
                $edital->documento = $caminho;
            }
        }
        $edital->save();
        return redirect()->route("op.editais",compact('editais'));
    }

    public static function editaisAbertos(){
        if(Auth::guard('operador')->user()->nivel == 0){
            $editais = Edital::all(['id'])->toArray();    
        }else{
            $om = Auth::guard('operador')->user()->id_om;
            $editais = Edital::where('id_om',$om)->get(['id'])->toArray();    
        }
        
        return $editais;
    }

    public static function editaisAbertosOM(){
            $om = Auth::guard('operador')->user()->id_om;
            $editais = Edital::where('id_om',$om)->get(['id'])->toArray();    
        return $editais;
    }

    public static function editaisOM(){
        $om = Auth::guard('operador')->user()->id_om;
        $editais = Edital::where('id_om',$om)->get();    
    return $editais;
}
}
