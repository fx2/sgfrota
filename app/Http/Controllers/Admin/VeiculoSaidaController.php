<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\ControleFrotum;
use App\Models\VeiculoSaida;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class VeiculoSaidaController extends Controller
{
    use CrudControllerTrait;

    private $model;
    private $path;
    private $redirectPath;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VeiculoSaida $veiculosaida)
    {
        $this->middleware('auth');
        $this->model = $veiculosaida;
        $this->path = 'admin.veiculo-saida';
        $this->redirectPath = 'veiculo-saida';
        $this->withFields = ['controle_frota', 'motorista'];
        $this->selectModelFields = ['ControleFrotum' => '\App\Models\ControleFrotum', 'Motoristum' => '\App\Models\Motoristum'];
        $this->joinSearch = [
            'motorista_id' => ['motorista', '\App\Models\Motoristum'],
            'controle_frota_id' => ['controle_frota', '\App\Models\ControleFrotum'],
        ];
        $this->fileName = [];
        $this->uploadFilePath = 'images/veiculo-saida';
        $this->validations = [
            'nome_responsavel' => 'required',
            'motorista_id' => 'required',
            'km_inicial' => 'required',
            'quantidade_combustivel' => 'required',
            'mecanica' => 'required',
            'eletrica' => 'required',
            'funilaria' => 'required',
            'pintura' => 'required',
            'pneus' => 'required',
            'macaco' => 'required',
            'triangulo' => 'required',
            'estepe' => 'required',
            'extintor' => 'required',
            'chave_roda' => 'required',
            'saida_data' => 'required',
            'saida_hora' => 'required',
            'status' => 'required',
        ];
        $this->pdfFields = [['motorista', 'nome'], ['controle_frota', 'veiculo'], ['nome_responsavel'], ['status']];
        $this->pdfTitles = ['Motorista', 'Veículo', 'Responsável', 'Status'];
        $this->indexFields = [['motorista', 'nome'], ['controle_frota', 'veiculo'], ['nome_responsavel'], ['status']];
        $this->indexTitles = ['Motorista', 'Veículo', 'Responsável', 'Status'];
    }

    public function create()
    {
        $id = $this->model::orderBy('id', 'desc')->first()['id'] ?? 0;
        $sequencial = $id + 1 . '/' .date('Y');  

        $controleFrotumDisponiveis = ControleFrotum::veiculosDisponiveisControleDiario('saida');

        return view($this->path.'.create', ['selectModelFields' => $this->selectModelFields(), 'sequencial' => $sequencial, 'controleFrotumDisponiveis' => $controleFrotumDisponiveis]);
    } 

    public function edit($id)
    {
        $controleFrotumDisponiveis = ControleFrotum::veiculosDisponiveisControleDiario('saida');

        $result = $this->model
          ->findOrFail($id);

        return view($this->path.'.edit', ['result' => $result, 'selectModelFields' => $this->selectModelFields(), 'controleFrotumDisponiveis' => $controleFrotumDisponiveis]);
    }

}
