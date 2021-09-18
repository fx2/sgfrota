<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VeiculoReservaEntrada extends BaseModel
{
    use SoftDeletes;

    const TIPO_DEVOLUCAO = 'devolucao';
    const TIPO_ENTRADA = 'entrada';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'veiculo_reserva_entradas';

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
    protected $fillable = ['tipo_veiculo_id',
        'setor_id',
        'tipo_responsavel_id',
        'tipo_responsavel',
        'tipo_combustivel_id',
        'marca_id',
        'modelo_id',
        'tipo_veiculo',
        'nome_proprietario',
        'disponivel_outros_departamentos',
        'veiculo_escolar',
        'certificado_vistoria',
        'vencto_vistoria_escolar',
        'renavan',
        'placa',
        'chassi',
        'especie_tipo',
        'veiculo',
        'ano_fabricacao',
        'ano_modelo',
        'capacidade',
        'cor',
        'patrimonio',
        'estado_veiculo',
        'km_inicial',
        'km_atual',
        'dut',
        'foto',
        'controle_frota_id',
        'entrada_forma_substituicao',
        'entrada_data',
        'entrada_horario',
        'entrada_combustivel',
        'entrada_recebido_por',
        'entrada_observacao',
        'auth_id',
        'status',
        'documento',
        'documento_devolucao',

        'tipo',

        // devolucao
        'devolucao_auth_id',
        'devolucao_data',
        'devolucao_horario',
        'devolucao_km_atual',
        'devolucao_combustivel',
        'devolucao_recebido_por',
        'devolucao_observacao',
    ];

     public function tipo_veiculoHasOne()
    {
        return $this->hasOne('App\Models\TipoVeiculo', 'id', 'tipo_veiculo_id');
    }

    public function tipo_combustivel()
    {
        return $this->hasOne('App\Models\TipoCombustivel', 'id', 'tipo_combustivel_id');
    }

    public function marca()
    {
        return $this->hasOne('App\Models\Marca', 'id', 'marca_id');
    }

    public function modelo()
    {
        return $this->hasOne('App\Models\Modelo', 'id', 'modelo_id');
    }

    public function responsavel()
    {
        return $this->hasOne('App\Models\TipoResponsavel', 'id', 'tipo_responsavel_id');
    }

    public function setor()
    {
        return $this->hasOne('App\Models\Setor', 'id', 'setor_id');
    }

    public function controle_frota()
    {
        return $this->hasOne('App\Models\ControleFrotum', 'id', 'controle_frota_id');
    }

    public function auth()
    {
        return $this->hasOne('App\Models\User', 'id', 'auth_id');
    }

    public function devolucaoAuth()
    {
        return $this->hasOne('App\Models\User', 'id', 'devolucao_auth_id');
    }
}
