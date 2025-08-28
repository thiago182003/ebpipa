<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = "municipios";
    protected $fillable = [
        'nome',
        'ibge',
        'status',
        'datainicio',
    ];

    protected $dates = [
        'datainicio'
    ];

    public function estado()
    {
    return $this->BelongsTo(Estado::class, 'id_estado');
    }

    public function om()
    {
        return $this->BelongsTo(Om::class);
    }
}
