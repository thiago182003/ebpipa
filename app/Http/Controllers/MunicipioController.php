<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Om;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MunicipioController extends Controller
{
    //
    public function municipios()
    {
        $nivel = Auth::guard('operador')->user()->nivel;
        $municipios = Municipio::all();
        if($nivel == 0){
            $municipios = Municipio::all();
        }else{
            $municipios = Municipio::where('id_om',Auth::guard('operador')->user()->id_om)->get();
        }
        foreach($municipios as $mun){
            $mun->estado = Estado::find($mun->id_estado);
            $mun->om = Om::find($mun->id_om);
        }
        
        return view("municipio.municipios",compact('municipios'));
    }

    public function novo()
    {
        
        $oms = OmController::buscarOms();
        $estados = Estado::all();
        return view("municipio.novo",compact('oms','estados'));
    }

    public function editar(Request $request)
    {
        $municipio = Municipio::find($request->id);
        $oms = OmController::buscarOms();
        $estados = Estado::all();
        // dd($municipio,$oms,$estados);
        return view("municipio.novo",compact('municipio','oms','estados'));
    }

    public function salvar(Request $request)
    {
        $om = Municipio::firstOrNew(['id' => $request->id]);
        $om->fill($request->all());
        $om->save();
        $municipios = Municipio::all();
        foreach($municipios as $mun){
            $mun->om = Om::find($mun->id_om);
            $mun->esmunicipiostado = Estado::find($mun->id_estado);
        }
        return redirect()->route("op.municipios",compact('municipios'));
    }

    public function deletar(Request $request){
        $id = $request->id;
        $municipio = Municipio::find($id);
        $municipio->delete();
    }
}
