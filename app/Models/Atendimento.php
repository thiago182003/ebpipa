<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    use HasFactory;

    protected $table = 'atendimentos';

    protected $fillable = [
        'usuario_autenticado',
        'user_type',
        'user_id',
        'user_name',
        'tipo_requerente',
        'outro_especificar',
        'estado',
        'municipio',
        'relato',
        'status',
        'resposta',
        'respondido_em',
        'respondido_por'
    ];

    protected $casts = [
        'usuario_autenticado' => 'boolean',
        'respondido_em' => 'datetime',
    ];

    /**
     * Relacionamento com o usuário que respondeu (operador)
     */
    public function respondidoPor()
    {
        return $this->belongsTo(Operador_user::class, 'respondido_por');
    }

    /**
     * Relacionamento polimórfico com o usuário que fez a solicitação
     */
    public function usuario()
    {
        switch ($this->user_type) {
            case 'pipeiro':
                return $this->belongsTo(Pipeiro_user::class, 'user_id');
            case 'empresa':
                return $this->belongsTo(Empresa_user::class, 'user_id');
            case 'operador':
                return $this->belongsTo(Operador_user::class, 'user_id');
            default:
                return null;
        }
    }

    /**
     * Scope para filtrar por status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope para filtrar por estado
     */
    public function scopeEstado($query, $estado)
    {
        return $query->where('estado', $estado);
    }

    /**
     * Scope para usuários autenticados
     */
    public function scopeAutenticados($query)
    {
        return $query->where('usuario_autenticado', true);
    }

    /**
     * Scope para usuários anônimos
     */
    public function scopeAnonimos($query)
    {
        return $query->where('usuario_autenticado', false);
    }
}
