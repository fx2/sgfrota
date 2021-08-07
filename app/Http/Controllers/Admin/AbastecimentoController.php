<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Abastecimento;
use App\Traits\CrudControllerTrait;

class AbastecimentoController extends Controller
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
    public function __construct(Abastecimento $abastecimento)
    {
        $this->middleware('auth');
        $this->model = $abastecimento;
        $this->saveSetorScope = true;
        $this->path = 'admin.abastecimento';
        $this->redirectPath = 'abastecimento';
        $this->withFields = ['controle_frota', 'tipo_combustivel', 'fornecedor', 'setor'];
        $this->selectModelFields = [
            'ControleFrotum' => '\App\Models\ControleFrotum',
            'TipoCombustivel' => '\App\Models\TipoCombustivel',
            'Fornecedor' => '\App\Models\Fornecedor',
            'Setor' => '\App\Models\Setor',
        ];
        $this->joinSearch = [
            'controle_frota_id' => ['controle_frota', '\App\Models\ControleFrotum'],
            'tipo_combustivel_id' => ['nome', '\App\Models\TipoCombustivel'],
            'fornecedor_id' => ['razao_social', '\App\Models\Fornecedor'],
            'setor_id' => ['nome', '\App\Models\Setor']
        ];
        $this->fileName = ['foto'];
        $this->uploadFilePath = 'images/abastecimento';
        $this->validations = [
            'qtd_litros' => 'required',
            'valor' => 'required',
            'controle_frota_id' => 'required|integer',
            'tipo_combustivel_id' => 'required|integer',
            'fornecedor_id' => 'required|integer',
            'foto' => 'required',
            'km_atual' => 'required',
            'responsavel' => 'required|string',
            'status' => 'required|boolean',
        ];

        $this->pdfFields = [
            ['data'], ['hora'], ['km_atual'], ['responsavel'], ['controle_frota', 'placa'], ['setor', 'nome'], ['tipo_combustivel', 'nome'],
            ['fornecedor', 'razao_social'], ['qtd_litros'], ['valor']
        ];
        $this->pdfTitles = ['Data','Horário', 'KM', 'Responsável', 'Veículo', 'Setor', 'Combustível', 'Fornecedor', 'Qtd Litros', 'Valor R$'];

        $this->indexFields = [['responsavel'], ['tipo_combustivel', 'nome'],['fornecedor', 'razao_social'], ['status']];
        $this->indexTitles = ['Responsável','Tipo de Combustível', 'Fornecedor', 'Status'];

        $this->numbersWithDecimal = ['km_atual', 'qtd_litros', 'valor'];
    }

    public function create()
    {
        $id = $this->model::orderBy('id', 'desc')->first()['id'] ?? 0;
        $sequencial = $id + 1 . '/' .date('Y');

        return view($this->path.'.create', ['selectModelFields' => $this->selectModelFields(), 'sequencial' => $sequencial]);
    }
}
