<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ControleFrotum extends BaseModel
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'controle_frotas';

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
        'tipo_veiculo',
        'nome_proprietario',
        'disponivel_outros_departamentos',
        'veiculo_escolar',
        'certificado_vistoria',
        'vencto_vistoria_escolar',
        'tipo_veiculo_id',
        'renavan',
        'placa',
        'chassi',
        'especie_tipo',
        'tipo_combustivel_id',
        'marca_id',
        'modelo_id',
        'veiculo',
        'ano_fabricacao',
        'ano_modelo',
        'capacidade',
        'cor',
        'patrimonio',
        'estado_veiculo',
        'km_inicial',
        'dut',
        'foto',
        'status',
        'tipo_responsavel',
        'tipo_responsavel_id',
        'setor_id',
        'km_atual',
        'revisao_com_km',
        'revisao_com_data',
        'vencimento_licenciamento',
        'data_vencimento_seguro'
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

    public function validaPlaca($placa, $id = null)
    {
        if ($id){
            $propriaPlaca = ControleFrotum::where('id', '=', $id)->where('placa', '=', $placa)->exists();
            if ($propriaPlaca)
                return true;
        }

        $placa = ControleFrotum::where('placa', '=', $placa)->exists();

        if ($placa)
            return false;

        return true;
    }
}
