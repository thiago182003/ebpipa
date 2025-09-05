<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class Empresa_user extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "empresa_users";
    protected $fillable = [
        'razaosocial',
        'cnpj',
        'email',
        'password',
        'nome',
        'nome_representante',
        'telefone_representante',
        'telefone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function credenciamentos()
    {
        return $this->hasMany(Credenciamento::class, 'id_empresa', 'id');
    }   
}
