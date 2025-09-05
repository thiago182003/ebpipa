<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CredenciamentoLog extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'credenciamento_id',
        'status_antigo',
        'status_novo',
        'alterado_por_id',
        'alterado_por_tipo',
        'data_alteracao',
    ];

    public $timestamps = false;

    public function alteradoPor()
    {
        // dd($this->alterado_por_id,$this->alterado_por_tipo);
        if($this->alterado_por_tipo == "operador"){
            $obj = Operador_user::find($this->alterado_por_id);
        }else if($this->alterado_por_tipo == "empresa"){
            $obj = Empresa_user::find($this->alterado_por_id);
        }else if($this->alterado_por_tipo == "pipeiro"){
            $obj = Pipeiro_user::find($this->alterado_por_id);
        }
        return $obj;
        
    }

    public function credenciamento()
    {
        return $this->belongsTo(Credenciamento::class);
    }

    public function credStatus($status){
        $resp ="";
        if($status == 1){
            $resp = "Documentação Aprovada";
        }else if($status == 2){
            $resp = "Em Correção";
        }else if($status == 3){
            $resp = "Para Análise";
        }else if($status == 4){
            $resp = "Corrigido";
        }else if($status == 98){
            $resp = "Aguardando Envio";
        }else if($status == 99){
            $resp = "Incompleto";
        }else{
            $resp = "";
        }
        return $resp;
    }

    public function getStatusAnteriorAttribute()
    {
        return self::credStatus($this->status_antigo);
    }

    public function getNovoStatusAttribute()
    {
        return self::credStatus($this->status_novo);
    }
}
