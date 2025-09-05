<?php

namespace App\Http\Controllers;

use App\Models\Om;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OmController extends Controller
{
    //

    public static function buscarOms(){
        $nivel = Auth::guard('operador')->user()->nivel;
        $id_om = Auth::guard('operador')->user()->id_om;
        if($nivel == 0){
            $oms = Om::all();
        }else{
            $oms = Om::where('id',$id_om)->orWhere('id_om',$id_om)->get();
        }
        return $oms;
    }

    public function oms()
    {
        $oms = OmController::buscarOms();
        return view("om.oms",compact('oms'));
    }

    public function novo()
    {
        $oms = OmController::buscarOms();
        return view("om.novo",compact('oms'));
    }

    public function editar(Request $request)
    {
        $om = Om::find($request->id);
        $oms = OmController::buscarOms();
        return view("om.novo",compact('om','oms'));
    }

    public function salvar(Request $request)
    {
        $om = Om::firstOrNew(['id' => $request->id]);
        $om->fill($request->all());
        $om->save();
        $oms = OmController::buscarOms();
        return redirect()->route("om.oms",compact('oms'));
    }

    public function deletar(Request $request){
        $id = $request->id;
        $om = Om::find($id);
        $om->delete();
    }

    

}
