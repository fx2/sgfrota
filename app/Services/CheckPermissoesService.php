<?php


namespace App\Services;

use App\Models\PermissoesUsuario;

class CheckPermissoesService
{
    /*
     * Se dada permissao existe dentro do rol de permissao, retorna-se true
     * */
    public function checarPermissao($user, int $idPermissao){
        if (\Gate::allows('isMasterOrAdmin'))
            return true;

        if (\Gate::allows('isMaster'))
            return true;

        return PermissoesUsuario::where('setor_id', $user->setor_id)
            ->where('perfil_id', $user->perfil_id)
            ->where('idpermissao', $idPermissao)
            ->exists();
    }
}
