<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Municipio extends Model
{
    use HasFactory;

    protected $table = "municipios";
    protected $fillable = [
        'nome',
        'ibge',
        'status',
        'datainicio',
        'id_estado',
        'id_om'
    ];

    protected $dates = [
        'datainicio'
    ];

    public function estado()
    {
        return $this->BelongsTo(Estado::class,'id_estado','id');
    }

    public function om()
    {
        return $this->BelongsTo(Om::class,'id_om','id');
    }

    
}
