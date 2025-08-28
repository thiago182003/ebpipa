<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtendimentoAnexo extends Model
{
    use HasFactory;

    protected $table = 'atendimento_anexos';

    protected $fillable = [
        'atendimento_id',
        'path',
        'original_name',
        'mime',
        'size',
    ];

    public function atendimento()
    {
        return $this->belongsTo(Atendimento::class);
    }
}
