<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operador_user extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "operador_users";
    protected $fillable = [
        'nome',
        'nomeguerra',
        'cpf',
        'email',
        'password',
        'id_om',
        'id_pg',
        'nivel'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pg()
    {
        return $this->BelongsTo(Pg::class,"id_pg");
    }

    // public function getAttribute($key)
    // {
    //     $value = parent::getAttribute($key);

    //     // Transforma em maiúsculas somente se o valor for uma string
    //     return is_string($value) ? Str::upper($value) : $value;
    // }
}
