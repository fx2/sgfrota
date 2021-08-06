<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manutencao extends BaseModel
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manutencaos';

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
        'setor_id',
        'modelo_id',
        'tipo_manutencao_id',
        'fornecedor_id',
        'controle_frota_id',
        'tipo_correcao_id',
        'responsavel_retirada',
        'descricao_manutencao',
        'numero_processo',
        'data',
        'hora',
        'valor',
        'status'];

    public function controle_frota()
    {
        return $this->hasOne('App\Models\ControleFrotum', 'id', 'controle_frota_id');
    }

    public function tipo_manutencao()
    {
        return $this->hasOne('App\Models\TipoManutencao', 'id', 'tipo_manutencao_id');
    }

    public function fornecedor()
    {
        return $this->hasOne('App\Models\Fornecedor', 'id', 'fornecedor_id');
    }

    public function tipo_correcao()
    {
        return $this->hasOne('App\Models\TipoCorrecao', 'id', 'tipo_correcao_id');
    }

    public function setor()
    {
        return $this->hasOne('App\Models\Setor', 'id', 'setor_id');
    }
}
