<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pipeiroCredenciamento extends Model
{
    use HasFactory;
    protected $table = "pipeiro_credenciamentos";
    protected $fillable = [
        'id_pipeiro',
        'id_credenciamento',
        'status'
    ];
}
