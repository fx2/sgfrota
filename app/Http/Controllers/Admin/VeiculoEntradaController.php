<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ControleFrotum;
use App\Models\VeiculoEntrada;
use App\Models\VeiculoSaida;
use App\Services\VeiculoEntradaService;
use App\Traits\CrudControllerTrait;
use Illuminate\Http\Request;

class VeiculoEntradaController extends Controller
{
    use CrudControllerTrait;

    private $model;
    private $path;
    private $redirectPath;

    /**
     * @var VeiculoEntradaService $veiculoEntradaService
     */
    private $veiculoEntradaService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VeiculoEntrada $veiculoentrada, VeiculoEntradaService $veiculoEntradaService)
    {
        $this->middleware('auth');

        $this->veiculoEntradaService = $veiculoEntradaService;

        $this->model = $veiculoentrada;
        $this->saveSetorScope = true;
        $this->path = 'admin.veiculo-entrada';
        $this->redirectPath = 'veiculo-entrada';
        $this->withFields = ['controle_frota', 'motorista', 'setor'];
        $this->selectModelFields = [
            'ControleFrotum' => '\App\Models\ControleFrotum',
            'Motoristum' => '\App\Models\Motoristum',
            'Setor' => '\App\Models\Setor'
        ];
        $this->joinSearch = [
            'motorista_id' => ['motorista', '\App\Models\Motoristum'],
            'controle_frota_id' => ['controle_frota', '\App\Models\ControleFrotum'],
            'setor_id' => ['setor', '\App\Models\Setor'],
        ];
        $this->fileName = [];
        $this->uploadFilePath = 'images/veiculo-entrada';
        $this->validations = [
            'nome_responsavel' => 'required',
            'controle_frota_id' => 'required',
            'motorista_id' => 'required',
            'km_final' => 'required',
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
            'entrada_data' => 'required',
            'entrada_hora' => 'required',
            'status' => 'required',
        ];
        $this->pdfFields = [
            ['entrada_data'], ['entrada_hora'], ['km_final'], ['motorista', 'nome'],  ['controle_frota', 'placa'], ['setor', 'nome'], ['nome_responsavel'], ['relatorio_trajeto_motorista']
        ];
        $this->pdfTitles = ['Data','Horário', 'KM', 'Motorista', 'Veículo', 'Setor', 'Responsável', 'Trajeto'];

        $this->indexFields = [['controle_frota', 'veiculo'], ['nome_responsavel'], ['status']];
        $this->indexTitles = ['Veículo', 'Responsável', 'Status'];

        $this->numbersWithDecimal = ['km_final', 'quantidade_combustivel'];
    }

    public function create()
    {
        $controleFrotumDisponiveis = $this->veiculoEntradaService->veiculosDisponiveisEntrada();

        return view($this->path.'.create', ['selectModelFields' => $this->selectModelFields(), 'controleFrotumDisponiveis' => $controleFrotumDisponiveis]);
    }

    public function edit($id)
    {
        $controleFrotumDisponiveis = $this->veiculoEntradaService->veiculosDisponiveisEntrada($id);

        $result = $this->model
          ->findOrFail($id);

        return view($this->path.'.edit', ['result' => $result, 'selectModelFields' => $this->selectModelFields(), 'withFields' => $this->withFields($result), 'controleFrotumDisponiveis' => $controleFrotumDisponiveis]);
    }

    public function store(Request $request)
    {
        $userAuth = auth('api')->user();

        $this->validate($request, $this->validations);

        $requestData = $request->all();

        if ($this->saveSetorScope){
            if ($userAuth->type !== 'master' AND $userAuth->type !== 'admin')
                $requestData['setor_id'] = $userAuth->setor_id;
        }

        $saida = VeiculoSaida::where('controle_frota_id', $requestData['controle_frota_id'])->first();

        $saida->delete();

        $this->model->create($requestData);

        return redirect($this->redirectPath)->withInput();
    }

}
