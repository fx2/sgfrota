<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Manutencao;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class ManutencaosController extends Controller
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
    public function __construct(Manutencao $lancamentomultas)
    {
        $this->middleware('auth');
        $this->model = $lancamentomultas;
        $this->saveSetorScope = true;
        $this->path = 'admin.manutencao';
        $this->redirectPath = 'manutencao';
        $this->withFields = ['controle_frota', 'tipo_manutencao', 'fornecedor', 'tipo_correcao'];
        $this->selectModelFields = [
            'ControleFrotum' => '\App\Models\ControleFrotum',
            'TipoManutencao' => '\App\Models\TipoManutencao',
            'Fornecedor' => '\App\Models\Fornecedor',
            'TipoCorrecao' => '\App\Models\TipoCorrecao',
            'Setor' => '\App\Models\Setor',
        ];
        $this->joinSearch = [
            'controle_frota_id' => ['controle_frota', '\App\Models\ControleFrotum'],
            'tipo_manutencao_id' => ['nome', '\App\Models\TipoManutencao'],
            'fornecedor_id' => ['razao_social', '\App\Models\Fornecedor'],
            'tipo_correcao_id' => ['nome', '\App\Models\TipoCorrecao'],
            'setor_id' => ['nome', '\App\Models\Setor'],
        ];
        $this->fileName = [];
        $this->uploadFilePath = 'images/';
        $this->validations = [
            'controle_frota_id' => 'required',
            'tipo_manutencao_id' => 'required',
            'fornecedor_id' => 'required',
            'responsavel_retirada' => 'required',
            'descricao_manutencao' => 'required',
            'numero_processo' => 'required',
            'data' => 'required',
            'hora' => 'required',
            'valor' => 'required',
            'tipo_correcao_id' => 'required',
            'status' => 'required',
        ];

        $this->indexFields = [['responsavel_retirada'], ['data'], ['hora'], ['status']];
        $this->indexTitles = ['Responsável', 'Data', 'Hora', 'Status'];

        $this->pdfFields = [['data'], ['responsavel_retirada'],  ['controle_frota', 'placa'], ['setor', 'nome'], ['tipo_manutencao', 'nome'], ['descricao_manutencao'], ['fornecedor', 'razao_social'], ['valor']];
        $this->pdfTitles = ['Data', 'Responsável', 'Veículo', 'Setor', 'Tipo', 'Descrição', 'Fornecedor', 'Valor R$'];

        $this->numbersWithDecimal = ['valor'];
    }

    public function create()
    {
        $id = $this->model::orderBy('id', 'desc')->first()['id'] ?? 0;
        $sequencial = $id + 1 . '/' .date('Y');

        return view($this->path.'.create', ['selectModelFields' => $this->selectModelFields(), 'sequencial' => $sequencial]);
    }

}
