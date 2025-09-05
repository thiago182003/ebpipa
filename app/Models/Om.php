<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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

    public function anexos()
    {
        return $this->hasOne(Anexo::class, 'id_om', 'id');
    }

    // public function getAttribute($key)
    // {
    //     $value = parent::getAttribute($key);

    //     // Transforma em maiúsculas somente se o valor for uma string
    //     return is_string($value) ? Str::upper($value) : $value;
    // }
}
