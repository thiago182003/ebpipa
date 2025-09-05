<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class endereco extends Model
{
    use HasFactory;

    protected $table = "enderecos";
    protected $fillable = [
        'id_pipeiro',
        'id_empresa',
        'cep',
        'logradouro',
        'bairro',
        'cidade',
        'comprovanteresidencia',
        'tipo',
        'numero',
        'id_credenciamento'
    ];

    // public function getAttribute($key)
    // {
    //     $value = parent::getAttribute($key);

    //     // Transforma em maiúsculas somente se o valor for uma string
    //     return is_string($value) ? Str::upper($value) : $value;
    // }
    
}