<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motoristum extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'motoristas';

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
        'motorista_escolar',
        'tipo_motorista',
        'certificado_transporte_escolar',
        'data_conclusao_curso',
        'fornecedor_id',
        'tipo_cnh_id',
        'nome',
        'rg',
        'cpf',
        'data_nascimento',
        'email',
        'telefone',
        'celular',
        'imagem',
        'cnh',
        'cnh_primeira',
        'cnh_validade',
        'cnh_emissao',
        'cnh_imagem',
        'avisar_antes_qtddias',
        'observacoes',
        'status',
        'img_upload'
    ];

    public function tipoCnh()
    {
        return $this->hasOne('App\Models\TipoCnh', 'id', 'tipo_cnh_id');
    }

    public function setor()
    {
        return $this->hasOne('App\Models\Setor', 'id', 'setor_id');
    }

    public function fornecedor()
    {
        return $this->hasOne('App\Models\Fornecedor', 'id', 'fornecedor_id');
    }
}
