<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentacaoCandidato extends Model
{
    use HasFactory;

    protected $table = "documentacoes_candidato";

    protected $fillable = [
        'candidato_id',
        'candidato_type',
        'edital_id',
        'documentacao_id',
        'arquivo',
        'status',
        'observacoes',
            
    ];

    public function documento()
    {
        return $this->BelongsTo(Documentacao::class,'documentacao_id','id');
    }

    public function edital()
    {
        return $this->BelongsTo(Edital::class,'edital_id','id');
    }
}
