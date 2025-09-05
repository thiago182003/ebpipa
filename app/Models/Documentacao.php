<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentacao extends Model
{
    use HasFactory;

    protected $table = "documentacao";

    protected $fillable = [
        'nome',
        'descricao',
        'link',
        'is_obrigatorio',
        'pessoa_fisica',
        'pessoa_juridica',
    ];
}
