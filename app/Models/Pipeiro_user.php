<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Controllers\CredenciamentoController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class Pipeiro_user extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "pipeiro_users";
    protected $fillable = [
        'id',
        'nome',
        'cpf',
        'email',
        'password',
        'identidade',
        'identidadeemissor',
        'identidadedata',
        'cnhnumero',
        'cnhcateg',
        'cnhcateg',
        'cnhdata',
        'telefone',
        'escolaridade',
        'estadocivil',
        'raca',
        'naturalidade',
        'nacionalidade',
        'img',
        'imgidtfrente', 
        'imgidtcosta',
        'cnhfrente',
        'cnhcosta',
        'foto_caminhao',
        'genero',
        'cnhfrente_status',
        'dtnascimento'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function credenciamentos()
    {
        return $this->hasMany(Credenciamento::class, 'id_pipeiro', 'id');
    }

    // public function getAttribute($key)
    // {
    //     $value = parent::getAttribute($key);

    //     // Transforma em maiúsculas somente se o valor for uma string
    //     return is_string($value) ? Str::upper($value) : $value;
    // }
    
}
