<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentacaoEdital extends Model
{
    use HasFactory;

    protected $table = "documentacoes_edital";
    protected $with = ['documento'];

    protected $fillable = [
        'edital_id',
        'is_obrigatorio',
        'documentacao_id'
    ];

    public function documento()
    {
        return $this->BelongsTo(Documentacao::class,'documentacao_id','id');
    }

}
