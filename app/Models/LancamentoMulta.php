<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LancamentoMulta extends BaseModel
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lancamento_multas';

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
    protected $fillable = ['motorista_id', 'modelo_id', 'tipo_multa_id', 'controle_frota_id', 'ocorrencias', 'numero_ait', 'estado_id', 'municipio_id', 'endereco_multa', 'data_multa', 'hora_multa', 'orgao_correspondente', 'enquadramento', 'data_vencimento', 'valor_multa', 'pago', 'foto_multa', 'status'];

    public function motorista()
    {
        return $this->hasOne('App\Models\Motoristum', 'id', 'motorista_id');
    }

    public function controle_frota()
    {
        return $this->hasOne('App\Models\ControleFrotum', 'id', 'controle_frota_id');
    }

    public function tipo_multa()
    {
        return $this->hasOne('App\Models\TipoMulta', 'id', 'tipo_multa_id');
    }
    
}
