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
    protected $fillable = ['sequencia', 'user_id', 'setor_id', 'data', 'horario', 'prioridade', 'solicitacao', 'numero_oficio', 'descricao', 'documento', 'respondendo_descricao', 'respondendo_user_id', 'respondendo_data', 'respondendo_horario', 'respondendo_documento', 'status'];

    
}
