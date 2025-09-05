<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class dadosbancarios extends Model
{
    use HasFactory;

    protected $table = "dadosbancarios";

    protected $fillable = [
        'id_pipeiro',
        'id_empresa',
        'banco',
        'codbanco',
        'agencia',
        'conta',
        'doc_comprovante',
        'id_credenciamento'
    ];

    public function dadosbanco(){
        return $this->belongsTo(Banco::class,'banco','id');
    }

    // public function getAttribute($key)
    // {
    //     $value = parent::getAttribute($key);

    //     // Transforma em maiúsculas somente se o valor for uma string
    //     return is_string($value) ? Str::upper($value) : $value;
    // }
}
