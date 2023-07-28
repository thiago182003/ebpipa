<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'veiculo_img'
    ];
}
