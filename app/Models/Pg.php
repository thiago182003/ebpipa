<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pg extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "pgs";
    protected $fillable = [
        'nome',
        'sigla',
        'imagem',
        'ord'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function instituition()
    {
        return $this->BelongsTo(Institution::class);
    }

    public function militares(){
        return $this->hasMany(Operador_user::class);
    }
}
