<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Edital extends Model
{
    use HasFactory;

    protected $table = "editals";
    // protected $appends = ['credenciado'];

    protected $fillable = [
        'nome',
        'datainicio',
        'datafim',
        'documento',
        'dtini1quad',
        'dtfim1quad',
        'dtini2quad',
        'dtfim2quad',
        'dtini3quad',
        'dtfim3quad',
        'id_om',
        'status',
    ];

    
    public function om()
    {
        return $this->BelongsTo(Om::class,'id_om','id');
    }

   
}
