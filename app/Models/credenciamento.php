<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class credenciamento extends Model
{
    use HasFactory;

    protected $table = "credenciamentos";

    protected $fillable = [
        'id',
        'id_pipeiro',
        'pipeiro',
        'id_empresa',
        'id_veiculo',
        'id_edital',
        'id_processo',
        'id_estado',
        'id_municipio',
        'status',
        'doc_reqcred',
        'doc_cico',
        'doc_cicips',
        'doc_cqe',
        'doc_cqsm',
        'doc_sicaf',
        'doc_ciscc',
        'doc_ciem',
        'doc_cndf',
        'doc_cnde',
        'doc_cndm',
        'doc_cidt',
        'doc_antt',
        'doc_lvs',
        'doc_act',
        'doc_maed',
        'doc_drctvc',
        'doc_cnis'
    ];

    protected $appends = ['cred_status'];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($credenciamento) {
            if ($credenciamento->isDirty('status')) {
                $tipo = Auth::guard('operador')->check() ? 'operador' : (Auth::guard('pipeiro')->check() ? 'pipeiro' : 'empresa');
                $id = Auth::guard('operador')->check() ? Auth::guard('operador')->user()->id : (Auth::guard('pipeiro')->check() ? Auth::guard('pipeiro')->user()->id : Auth::guard('empresa')->user()->id);

                \App\Models\CredenciamentoLog::create([
                    'credenciamento_id' => $credenciamento->id,
                    'status_antigo' => $credenciamento->getOriginal('status'),
                    'status_novo' => $credenciamento->status,
                    'alterado_por_id' => $id,
                    'alterado_por_tipo' => $tipo,
                    'data_alteracao' => now(),
                ]);
            }
        });
    }

    public function credStatus($status)
    {
        $resp = "";
        if ($status == 1) {
            $resp = "Documentação Aprovada";
        } else if ($status == 2) {
            $resp = "Em Correção";
        } else if ($status == 3) {
            $resp = "Para Análise";
        } else if ($status == 4) {
            $resp = "Corrigido";
        } else if ($status == 90) {
            $resp = "Descredenciado";
        } else if ($status == 98) {
            $resp = "Aguardando Envio";
        } else if ($status == 99) {
            $resp = "Incompleto";
        }
        return $resp;
    }

    public function getCredStatusAttribute()
    {
        $resp = ""; 
        if ($this->status == 1) {
            $resp = "Documentação Aprovada";
        } else if ($this->status == 2) {
            $resp = "Em Correção";
        } else if ($this->status == 3) {
            $resp = "Para Análise";
        } else if ($this->status == 4) {
            $resp = "Corrigido";
        } else if ($this->status == 90) {
            $resp = "Descredenciado";
        } else if ($this->status == 98) {
            $resp = "Aguardando Envio";
        } else if ($this->status == 99) {
            $resp = "Incompleto";
        }
        return $resp;
    }

    public function getStatusDescriptionAttribute()
    {
        return self::credStatus($this->status);
    }


    public function pipeiro()
    {
        return $this->BelongsTo(Pipeiro_user::class, 'id_pipeiro', 'id');
    }

    public function empresa()
    {
        return $this->BelongsTo(Empresa_user::class, 'id_empresa', 'id');
    }

    public function veiculo()
    {
        return $this->BelongsTo(veiculo::class, 'id', 'id_credenciamento');
    }

    public function dadosbancarios()
    {
        return $this->BelongsTo(dadosbancarios::class, 'id', 'id_credenciamento');
    }

    public function endereco()
    {
        return $this->BelongsTo(endereco::class, 'id', 'id_credenciamento');
    }

    public function edital()
    {
        return $this->BelongsTo(Edital::class, 'id_edital', 'id');
    }

    public function municipio()
    {
        return $this->BelongsTo(Municipio::class, 'id_municipio', 'id');
    }

    public function om()
    {
        return $this->hasOneThrough(Om::class, Edital::class, 'id', 'id', 'id_edital', 'id_om');
    }

    /**
     * Retorna uma coleção de credenciamentos completos para o pipeiro informado.
     *
     * @param int $id_pipeiro ID do pipeiro
     * @param int $id_cred ID do credenciamento (opcional, padrão: 0)
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\credenciamento[] Coleção de credenciamentos
     */
    public static function pipeiroCompleto($id_pipeiro, $id_cred = 0)
    {

        if ($id_cred == 0) {
            $credenciamentos = credenciamento::with('pipeiro')
                ->with('veiculo')
                ->with('dadosbancarios')
                ->with('endereco')
                ->with('edital')
                ->with('om')
                ->where('id_pipeiro', $id_pipeiro)
                ->where('status', '!=', '90')
                ->get();
        } else {
            $credenciamentos = credenciamento::with('pipeiro')
                ->with('veiculo')
                ->with('dadosbancarios')
                ->with('endereco')
                ->with('edital')
                ->with('om')
                ->where('status', '!=', '90')
                ->where(['id_pipeiro' => $id_pipeiro, 'id' => $id_cred])->get();
        }
        return $credenciamentos;
    }

    public static function empresaCompleto($id_empresa, $id_cred = 0)
    {
        if ($id_cred == 0) {
            $credenciamentos = credenciamento::with('empresa')
                ->with('dadosbancarios')
                ->with('endereco')
                ->with('edital')
                ->where('status', '!=', '90')
                ->where('id_empresa', $id_empresa)

                ->whereNull('id_pipeiro')
                ->get();
        } else {
            $credenciamentos = credenciamento::with('empresa')
                ->with('dadosbancarios')
                ->with('endereco')
                ->with('edital')
                ->where('status', '!=', '90')
                ->where(['id_empresa' => $id_empresa, 'id' => $id_cred])
                ->whereNull('id_pipeiro')
                ->get();
        }
        return $credenciamentos;
    }

    public static function motoristas($id_empresa, $id_cred = 0)
    {
        if ($id_cred == 0) {
            $credenciamentos = credenciamento::with('empresa')
                ->with('veiculo')
                ->with('pipeiro')
                ->with('endereco')
                ->with('edital')
                ->where('id_empresa', $id_empresa)
                ->where('status', '!=', '90')
                ->whereNotNull('id_pipeiro')
                ->get();
        } else {
            $credenciamentos = credenciamento::with('empresa')
                ->with('veiculo')
                ->with('pipeiro')
                ->with('endereco')
                ->with('edital')
                ->where('status', '!=', '90')
                ->where(['id_empresa' => $id_empresa, 'id' => $id_cred])
                ->whereNotNull('id_pipeiro')
                ->get();
        }
        return $credenciamentos;
    }

    public function logs()
    {
        return $this->hasMany(CredenciamentoLog::class);
    }
}
