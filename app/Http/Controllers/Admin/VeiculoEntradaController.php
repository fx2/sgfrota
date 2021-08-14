<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ControleFrotum;
use App\Models\VeiculoEntrada;
use App\Models\VeiculoSaida;
use App\Services\ControleFrotumKmService;
use App\Services\VeiculoEntradaService;
use App\Traits\CrudControllerTrait;
use Illuminate\Http\Request;
use PDF;

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
     * @var ControleFrotumKmService $controleFrotumKmService
     */
    private $controleFrotumKmService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VeiculoEntrada $veiculoentrada, VeiculoEntradaService $veiculoEntradaService, ControleFrotumKmService $controleFrotumKmService)
    {
        $this->middleware('auth');

        $this->veiculoEntradaService = $veiculoEntradaService;
        $this->controleFrotumKmService = $controleFrotumKmService;

        $this->model = $veiculoentrada;
        $this->saveSetorScope = true;
        $this->path = 'admin.veiculo-entrada';
        $this->redirectPath = 'veiculo-entrada';
        $this->withFields = ['controle_frota', 'motorista', 'setor', 'veiculo_saida'];
        $this->selectModelFields = [
            'ControleFrotum' => '\App\Models\ControleFrotum',
            'Motoristum' => '\App\Models\Motoristum',
            'Setor' => '\App\Models\Setor',
            'VeiculoSaida' => '\App\Models\VeiculoSaida'
        ];
        $this->joinSearch = [
            'motorista_id' => ['motorista', '\App\Models\Motoristum'],
            'controle_frota_id' => ['controle_frota', '\App\Models\ControleFrotum'],
            'setor_id' => ['setor', '\App\Models\Setor'],
            'veiculo_saida_id' => ['veiculo_saida', '\App\Models\VeiculoSaida'],
        ];
        $this->fileName = ['document'];
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

        ];
        $this->pdfTitles = ['Data Entrada','Hora Entrada', 'KM', 'Motorista', 'Veículo', 'Setor', 'Responsável', 'Trajeto', 'Data Saída', 'Hora Saída'];

        $this->indexFields = [['controle_frota', 'veiculo'], ['controle_frota', 'placa'], ['entrada_data'], ['entrada_hora'], ['nome_responsavel'], ['status']];
        $this->indexTitles = ['Veículo', 'Placa', 'Data Entrada', 'Hora Entrada', 'Responsável',  'Status'];

        $this->pdfindividualFields = [['controle_frota', 'veiculo'], ['motorista', 'nome'], ['km_final'],['relatorio_trajeto_motorista'],['quantidade_combustivel'],['observacao'],['nome_responsavel'],['mecanica'],['eletrica'],['funilaria'],['pintura'],['pneus'],['observacao_situacao'],['macaco'],['triangulo'],['estepe'],['extintor'],['chave_roda'],['observacao_acessorio'],['entrada_data'],['entrada_hora']];
        $this->pdfindividualTitles = ['Motorista', 'Veículo', 'km_final', 'relatorio_trajeto_motorista', 'quantidade_combustivel', 'observacao', 'nome_responsavel', 'mecanica', 'eletrica', 'funilaria', 'pintura', 'pneus', 'observacao_situacao', 'macaco', 'triangulo', 'estepe', 'extintor', 'chave_roda', 'observacao_acessorio', 'entrada_data', 'entrada_hora'];

        $this->pdfTitle = 'REGISTRO DIÁRIO DE SAÍDA E TRAJETÓRIA DO VEÍCULO';

        $this->numbersWithDecimal = ['km_final'];

        $this->pdfGeralPath = 'admin/pdf/veiculoEntrada/relatorio-geral';
    }

    public function customShowPdf($id)
    {
        $result = $this->model::where('id', $id);

        $data = [
            'results' => $result->withTrashed()->first(),
            'fields' => $this->pdfindividualFields,
            'titles' => $this->pdfindividualTitles,
            'pdfTitle' => $this->pdfTitle
        ];

        $pdf = PDF::loadView('admin/pdf/veiculoEntrada/relatorio-geral-new', $data);
        $pdfModelName = str_replace("admin.", "", $this->path); // TODO: mexer nesse admin. caso mude a pasta

        // return $pdf->download($pdfModelName . '.pdf');
        return $pdf->stream($pdfModelName . '.pdf');
    }

    public function show($id)
    {
        $result = $this->model
          ->findOrFail($id);

        $controleFrotumDisponiveis = VeiculoEntrada::select('controle_frotas.id', 'controle_frotas.veiculo')
            ->join('controle_frotas', 'controle_frotas.id', '=', 'veiculo_entradas.controle_frota_id')
            ->where('veiculo_entradas.id', $id)->withTrashed()->get();

        return view($this->path.'.show', ['result' => $result, 'selectModelFields' => $this->selectModelFields(), 'controleFrotumDisponiveis' => $controleFrotumDisponiveis]);
    }

    public function create()
    {
        $controleFrotumDisponiveis = $this->veiculoEntradaService->veiculosDisponiveisEntrada();

        return view($this->path.'.create', ['selectModelFields' => $this->selectModelFields(), 'controleFrotumDisponiveis' => $controleFrotumDisponiveis]);
    }

//    public function edit($id)
//    {
//        $controleFrotumDisponiveis = $this->veiculoEntradaService->veiculosDisponiveisEntrada($id);
//
//        $result = $this->model
//          ->findOrFail($id);
//
//        return view($this->path.'.edit', ['result' => $result, 'selectModelFields' => $this->selectModelFields(), 'withFields' => $this->withFields($result), 'controleFrotumDisponiveis' => $controleFrotumDisponiveis]);
//    }

    public function store(Request $request)
    {
        $userAuth = auth('api')->user();

        $this->validate($request, $this->validations);

        $requestData = $request->all();
        $requestData['auth_id'] = $userAuth->id;

        $verificaKM = $this->controleFrotumKmService->atualizaKilometragem($requestData['controle_frota_id'], $requestData['km_final'], true);
        if ($verificaKM !== true){
            toastr()->error("Kilometragem inicial deve ser maior que {$verificaKM}");
            return redirect()->back()->withInput();
        }

        $veiculo_saida = explode('-', $requestData['controle_frota_id']);
        $requestData['controle_frota_id'] = $veiculo_saida[0];
        $requestData['veiculo_saida_id'] = $veiculo_saida[1];

        if ($this->saveSetorScope){
            if ($userAuth->type !== 'master' AND $userAuth->type !== 'admin')
                $requestData['setor_id'] = $userAuth->setor_id;
        }

        if (!empty($this->fileName)) {
            $requestData = $this->eachFiles($requestData, $request);
        }

        if (!empty($this->numbersWithDecimal)) {
            $requestData = $this->formatRemoveDecimal($requestData);
        }

        $saida = VeiculoSaida::where('controle_frota_id', $requestData['controle_frota_id'])->first();
//        $saida->status = 0;
        $saida->deleted_at = date("Y-m-d H:i:s");
        $saida->save();

        $create = $this->model->create($requestData);

        $this->LogModelo($create->id, 'cadastro', $this->model->getTable(), $requestData, null, $userAuth, $create->setor_id);

        $this->LogModelo($saida->id, 'deletou', $this->model->getTable(), $saida,  null, $userAuth, $saida->setor_id);

        return redirect($this->redirectPath)->withInput();
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
            $result = $result->whereDate('entrada_hora', '>=', convertTimestampToBd($requestData['data_inicial'], 'Y-m-d'));

        if($requestData['data_final'] !== null)
            $result = $result->whereDate('entrada_hora', '<=', convertTimestampToBd($requestData['data_final'], 'Y-m-d'));

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
