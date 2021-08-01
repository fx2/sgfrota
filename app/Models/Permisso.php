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
    public function checarPermissaoTelaPerfil(int $idPermissao, $perfil_id){
        $user = auth('api')->user();

        return PermissoesUsuario::where('setor_id', $user->setor_id)
            ->where('perfil_id', $perfil_id)
            ->where('idpermissao', $idPermissao)
            ->exists();

    }

    const FORNECEDOR_VISUALIZAR = 1;
    const FORNECEDOR_ADICIONAR = 2;
    const FORNECEDOR_EDITAR = 3;
    const FORNECEDOR_DELETAR = 4;
    const FORNECEDOR_RELATORIO = 5;

    const CONTROLEDEFROTAS_VISUALIZAR = 6;
    const CONTROLEDEFROTAS_ADICIONAR = 7;
    const CONTROLEDEFROTAS_EDITAR = 8;
    const CONTROLEDEFROTAS_DELETAR = 9;
    const CONTROLEDEFROTAS_RELATORIO = 10;

    const ABASTECIMENTOS_VISUALIZAR = 11;
    const ABASTECIMENTOS_ADICIONAR = 12;
    const ABASTECIMENTOS_EDITAR = 13;
    const ABASTECIMENTOS_DELETAR = 14;
    const ABASTECIMENTOS_RELATORIO = 15;

    const MOTORISTAS_VISUALIZAR = 16;
    const MOTORISTAS_ADICIONAR = 17;
    const MOTORISTAS_EDITAR = 18;
    const MOTORISTAS_DELETAR = 19;
    const MOTORISTAS_RELATORIO = 20;

    const MANUTENCAODESPESAS_VISUALIZAR = 21;
    const MANUTENCAODESPESAS_ADICIONAR = 22;
    const MANUTENCAODESPESAS_EDITAR = 23;
    const MANUTENCAODESPESAS_DELETAR = 24;
    const MANUTENCAODESPESAS_RELATORIO = 25;

    const LANCAMENTODEMULTAS_VISUALIZAR = 26;
    const LANCAMENTODEMULTAS_ADICIONAR = 27;
    const LANCAMENTODEMULTAS_EDITAR = 28;
    const LANCAMENTODEMULTAS_DELETAR = 29;
    const LANCAMENTODEMULTAS_RELATORIO = 30;

    const CONTROLEDIARIODESAIDA_VISUALIZAR = 31;
    const CONTROLEDIARIODESAIDA_ADICIONAR = 32;
    const CONTROLEDIARIODESAIDA_EDITAR = 33;
    const CONTROLEDIARIODESAIDA_DELETAR = 34;
    const CONTROLEDIARIODESAIDA_RELATORIO = 35;

    const CONTROLEDIARIODEENTRADA_VISUALIZAR = 36;
    const CONTROLEDIARIODEENTRADA_ADICIONAR = 37;
    const CONTROLEDIARIODEENTRADA_EDITAR = 38;
    const CONTROLEDIARIODEENTRADA_DELETAR = 39;
    const CONTROLEDIARIODEENTRADA_RELATORIO = 40;

    const AGENDAMENTODEVEICULOS_VISUALIZAR = 41;
    const AGENDAMENTODEVEICULOS_ADICIONAR = 42;
    const AGENDAMENTODEVEICULOS_EDITAR = 43;
    const AGENDAMENTODEVEICULOS_DELETAR = 44;
    const AGENDAMENTODEVEICULOS_RELATORIO = 45;

    const ADMINAGENDAMENTODEVEICULOS_VISUALIZAR = 46;
    const ADMINAGENDAMENTODEVEICULOS_ADICIONAR = 47;
    const ADMINAGENDAMENTODEVEICULOS_EDITAR = 48;
    const ADMINAGENDAMENTODEVEICULOS_DELETAR = 49;
    const ADMINAGENDAMENTODEVEICULOS_RELATORIO = 50;

}
