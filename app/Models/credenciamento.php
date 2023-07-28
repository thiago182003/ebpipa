<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class credenciamento extends Model
{
    use HasFactory;

    protected $table = "credenciamentos";

    protected $fillable = [
        'id_pipeiro',
        'pipeiro',
        'id_empresa',
        'id_veiculo',
        'id_edital',
        'id_processo',
        'id_estado',
        'id_municipio',
        'status',
        'doc_reqcred',
        'doc_cico',
        'doc_cicips',
        'doc_cqe',
        'doc_cqsm',
        'doc_sicaf',
        'doc_ciscc',
        'doc_ciem',
        'doc_cndf',
        'doc_cnde',
        'doc_cndm',
        'doc_cidt',
        'doc_antt',
        'doc_lvs',
        'doc_act',
        'doc_maed',
        'doc_drctvc',
        'doc_cnis'
    ];

    public function pipeiro()
    {
    }
}
