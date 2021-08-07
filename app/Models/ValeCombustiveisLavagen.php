<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ValeCombustiveisLavagen extends BaseModel
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vale_combustiveis_lavagens';

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
    protected $fillable = ['setor_id', 'tipo_vale', 'controle_frota_id', 'quantidade_litros', 'tipo_combustivel_id', 'data', 'hour', 'nome_responsavel', 'observacao', 'status'];

    public function controle_frota()
    {
        return $this->hasOne('App\Models\ControleFrotum', 'id', 'controle_frota_id');
    }

    public function tipo_combustivel()
    {
        return $this->hasOne('App\Models\TipoCombustivel', 'id', 'tipo_combustivel_id');
    }

    public function setor()
    {
        return $this->hasOne('App\Models\Setor', 'id', 'setor_id');
    }

}
