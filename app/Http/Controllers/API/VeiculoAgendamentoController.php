<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ControleFrotum;
use App\Models\VeiculoAgendamento;
use App\Traits\ApiControllerTrait;

class VeiculoAgendamentoController extends Controller
{
    use ApiControllerTrait;

    private $model;

    public function __construct(VeiculoAgendamento $user){
        $this->model = $user;
        // $this->relationships = 'post';
    }
}
