<?php

namespace App\Http\Middleware;

use App\Models\PermissoesUsuario;
use Closure;
use Illuminate\Http\Request;

class CheckSetor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $id)
    {
        $permissao = $this->checarPermissao($id);

        if (!$permissao)
            return redirect('home');

        return $next($request);
    }

    /*
     * Se dada permissao existe dentro do rol de permissao, retorna-se true
     * */
    public function checarPermissao(int $idPermissao){
        $user = auth('api')->user();

        return PermissoesUsuario::where('setor_id', $user->setor_id)
            ->where('perfil_id', $user->perfil_id)
            ->where('idpermissao', $idPermissao)
            ->exists();
    }
}
