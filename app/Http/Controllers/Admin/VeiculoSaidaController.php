<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\ControleFrotum;
use App\Models\VeiculoSaida;
use App\Services\VeiculoSaidaService;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class VeiculoSaidaController extends Controller
{
    use CrudControllerTrait;

    private $model;
    private $path;
    private $redirectPath;

    /**
     * @var VeiculoSaidaService $veiculoSaidaService
     */
    private $veiculoSaidaService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VeiculoSaida $veiculosaida, VeiculoSaidaService $veiculoSaidaService)
    {
        $this->middleware('auth');

        $this->veiculoSaidaService = $veiculoSaidaService;

        $this->model = $veiculosaida;
        $this->saveSetorScope = true;
        $this->path = 'admin.veiculo-saida';
        $this->redirectPath = 'veiculo-saida';
        $this->withFields = ['controle_frota', 'motorista'];
        $this->selectModelFields = [
            'ControleFrotum' => '\App\Models\ControleFrotum',
            'Motoristum' => '\App\Models\Motoristum',
            'Setor' => '\App\Models\Setor'
        ];
        $this->joinSearch = [
            'motorista_id' => ['motorista', '\App\Models\Motoristum'],
            'controle_frota_id' => ['controle_frota', '\App\Models\ControleFrotum'],
            'setor_id' => ['controle_frota', '\App\Models\Setor'],
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

        $this->numbersWithDecimal = ['km_inicial', 'quantidade_combustivel'];
    }

    public function create()
    {
        $id = $this->model::orderBy('id', 'desc')->first()['id'] ?? 0;
        $sequencial = $id + 1 . '/' .date('Y');

        $controleFrotumDisponiveis = $this->veiculoSaidaService->veiculosDisponiveisSaida();

        return view($this->path.'.create', ['selectModelFields' => $this->selectModelFields(), 'sequencial' => $sequencial, 'controleFrotumDisponiveis' => $controleFrotumDisponiveis]);
    }

    public function edit($id)
    {
        $controleFrotumDisponiveis = $this->veiculoSaidaService->veiculosDisponiveisSaida($id);

        $result = $this->model
          ->findOrFail($id);

        return view($this->path.'.edit', ['result' => $result, 'selectModelFields' => $this->selectModelFields(), 'controleFrotumDisponiveis' => $controleFrotumDisponiveis]);
    }

    public function customListagem(Request $request)
    {
        $limit = $request->all()['limit'] ?? 20;

        $result = $this->model;
        $requestData = $request->all();

        if($requestData['controle_frota_id'] !== null)
            $result = $result->where('controle_frota_id', '=', $requestData['controle_frota_id']);

        if($requestData['motorista_id'] !== null)
            $result = $result->where('motorista_id', '=', $requestData['motorista_id']);

        if($requestData['data_inicial'] !== null)
            $result = $result->whereDate('saida_data', '>=', convertTimestampToBd($requestData['data_inicial'], 'Y-m-d'));

        if($requestData['data_final'] !== null)
            $result = $result->whereDate('saida_data', '<=', convertTimestampToBd($requestData['data_final'], 'Y-m-d'));

        if (\Gate::allows('isMasterOrAdmin')){
            if($requestData['setor_id'] !== null)
                $result = $result->where('setor_id', '=', $requestData['setor_id']);
        } else {
            $result = $result->where('setor_id', '=', auth('api')->user()->setor_id);
        }

        if ($request->export_pdf == "true")
            return $this->exportPdf($result);

        $result = $result->paginate($limit);

        return view($this->path.'.index', ['results'=>$result, 'request'=> $requestData, 'selectModelFields' => $this->selectModelFields(), 'fields' => $this->indexFields, 'titles' => $this->indexTitles]);
    }

}
