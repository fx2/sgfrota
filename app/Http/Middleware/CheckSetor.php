<?php

namespace App\Http\Middleware;

use App\Models\PermissoesUsuario;
use App\Services\CheckPermissoesService;
use Closure;
use Illuminate\Http\Request;

class CheckSetor
{
    private $checkPermissoesService;
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(CheckPermissoesService $checkPermissoesService)
    {
        $this->checkPermissoesService = $checkPermissoesService;
    }

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

        return $this->checkPermissoesService->checarPermissao($user, $idPermissao);
    }
}
