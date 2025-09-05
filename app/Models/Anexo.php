<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_om',
        'requerimento_credenciamento',
        'conhecimento_das_informacoes',
        'condicao_do_veiculo',
        'exposicao_dados',
        'trabalho_de_menor',
    ];
}
