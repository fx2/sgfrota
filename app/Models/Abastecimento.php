<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Abastecimento extends BaseModel
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'abastecimentos';

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
        'tipo_combustivel_id',
        'fornecedor_id',
        'km_atual',
        'responsavel',
        'foto',
        'qtd_litros',
        'data',
        'hora',
        'valor',
        'status'];

    public function controle_frota()
    {
        return $this->hasOne('App\Models\ControleFrotum', 'id', 'controle_frota_id');
    }

    public function tipo_combustivel()
    {
        return $this->hasOne('App\Models\TipoCombustivel', 'id', 'tipo_combustivel_id');
    }

    public function fornecedor()
    {
        return $this->hasOne('App\Models\Fornecedor', 'id', 'fornecedor_id');
    }

    public function setor()
    {
        return $this->hasOne('App\Models\Setor', 'id', 'setor_id');
    }

}
