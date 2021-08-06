<?php

namespace App\Policies;

use App\Models\PermissoesUsuario;
use App\Models\User;
use App\Services\CheckPermissoesService;
use Illuminate\Auth\Access\HandlesAuthorization;

class CheckSetorPolicy
{
    use HandlesAuthorization;

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

    public function checksetor($user, $permissao){
        return $this->checkPermissoesService->checarPermissao($user, $permissao);
    }
}
