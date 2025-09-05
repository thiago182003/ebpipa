<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class veiculo extends Model
{
    use HasFactory;
    protected $table = "veiculos";
    protected $fillable = [
        'id_pipeiro',
        'id_empresa',
        'placa',
        'marca',
        'modelo',
        'ano',
        'chassi',
        'doc_crlv',
        'doc_lav',
        'veiculo_img',
        'proprio',
        'doc_cl',
        'doc_cl_status',
        'doc_cl_obs',
        'veiculo_img',
        'id_credenciamento'
    ];

    // public function getAttribute($key)
    // {
    //     $value = parent::getAttribute($key);

    //     // Transforma em maiúsculas somente se o valor for uma string
    //     return is_string($value) ? Str::upper($value) : $value;
    // }
}
