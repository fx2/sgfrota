<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VeiculoSaida extends BaseModel
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'veiculo_saidas';

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
        'controle_frota_id',
        'motorista_id',
        'nome_responsavel',
        'km_inicial',
        'quantidade_combustivel',
        'mecanica',
        'eletrica',
        'funilaria',
        'pintura',
        'pneus',
        'observacao_situacao',
        'macaco',
        'triangulo',
        'estepe',
        'extintor',
        'chave_roda',
        'observacao_acessorio',
        'status',
        'saida_data',
        'saida_hora'
    ];

    public function controle_frota()
    {
        return $this->hasOne('App\Models\ControleFrotum', 'id', 'controle_frota_id');
    }

    public function motorista()
    {
        return $this->hasOne('App\Models\Motoristum', 'id', 'motorista_id');
    }
}
