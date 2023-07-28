<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'doc_comprovante'
    ];
}
