<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empresaCredenciamento extends Model
{
    use HasFactory;
    protected $table = "empresa_credenciamentos";
    protected $fillable = [
        'id_empresa',
        'id_credenciamento',
        'status'
    ];
}
