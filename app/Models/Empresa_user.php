<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
}
