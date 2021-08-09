<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permisso extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissoes';

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
    protected $fillable = ['titulo', 'quem_pertence', 'chave_ordem', 'ordem_exibicao', 'avo', 'permissao_direta', 'pai', 'descricao', 'status'];

     public function filhasQuemPertence(){
        return $this->hasMany(self::class, 'avo', 'quem_pertence');
	}

	public function netosQuemPertence(){
        return $this->hasMany(self::class, 'pais', 'quem_pertence');
    }

    /*
     * Se dada permissao existe dentro do rol de permissao, retorna-se true
     * */
    public function checarPermissaoTelaPerfil(int $idPermissao, $perfil_id, $setor_id){
//        $user = auth('api')->user();

        return PermissoesUsuario::where('setor_id', $setor_id)
            ->where('perfil_id', $perfil_id)
            ->where('idpermissao', $idPermissao)
            ->exists();
    }
}
