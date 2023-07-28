<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'numero'
    ];
}
