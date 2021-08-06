<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modelo extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'modelos';

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
    protected $fillable = ['tipo_veiculo_id', 'marca_id', 'modelo', 'descricao', 'status'];

    public function tipo_veiculo()
    {
        return $this->hasOne('App\Models\TipoVeiculo', 'id', 'tipo_veiculo_id');
    }
    public function marca()
    {
        return $this->hasOne('App\Models\Marca', 'id', 'marca_id');
    }

}
