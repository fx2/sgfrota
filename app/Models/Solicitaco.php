<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitaco extends BaseModel
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'solicitacoes';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sequencia',
        'auth_id',
        'setor_id',
        'data',
        'horario',
        'prioridade',
        'solicitacao_id',
        'numero_oficio',
        'descricao',
        'documento',
        'respondendo_descricao',
        'respondendo_auth_id',
        'respondendo_data',
        'respondendo_horario',
        'respondendo_documento',
        'etapa',
        'status'
    ];

    public function setor()
    {
        return $this->hasOne('App\Models\Setor', 'id', 'setor_id');
    }
    
    public function userAuth()
    {
        return $this->hasOne('App\Models\User', 'id', 'auth_id');
    }
    
    public function userAuthRespondido()
    {
        return $this->hasOne('App\Models\User', 'id', 'respondendo_auth_id');
    }
    
    public function respondendoUserAuth()
    {
        return $this->hasOne('App\Models\User', 'id', 'respondendo_auth_id');
    }
    
    public function tipoSolicitacao()
    {
        return $this->hasOne('App\Models\TipoSolicitacao', 'id', 'solicitacao_id');
    }
}
