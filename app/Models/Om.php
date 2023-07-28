<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Om extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "oms";
    protected $fillable = [
        'nome',
        'sigla',
        'imagem',
        'denominacao',
        'id_om'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
