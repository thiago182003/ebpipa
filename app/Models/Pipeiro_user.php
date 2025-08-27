<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pipeiro_user extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "pipeiro_users";
    protected $fillable = [
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
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'id'
    ];

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'cpf';
    }
}
