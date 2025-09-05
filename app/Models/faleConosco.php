<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faleConosco extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'assunto',
        'anexo'
    ];
}
