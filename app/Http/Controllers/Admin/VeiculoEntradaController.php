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
        // $this->middleware('checksetor:' . CONTROLEDIARIODEENTRADA_VISUALIZAR, ['only' => ['index']]);
        // $this->middleware('checksetor:' . CONTROLEDIARIODEENTRADA_ADICIONAR, ['only' => ['create']]);
        // $this->middleware('checksetor:' . CONTROLEDIARIODEENTRADA_EDITAR, ['only' => ['edit']]);
        // $this->middleware('checksetor:' . CONTROLEDIARIODEENTRADA_DELETAR, ['only' => ['destroy']]);
        // $this->middleware('checksetor:' . CONTROLEDIARIODEENTRADA_RELATORIO, ['only' => ['relatorio']]);

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
//            'quantidade_combustivel' => 'required',
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
//DtSaída/KmSaída/DtEntrada/KmEntrada/Placa/Motorista/Setor/Trajeto
        $this->pdfFields = [
            ['veiculo_saida', 'saida_data'],
            ['veiculo_saida', 'saida_hora'],
            ['veiculo_saida', 'km_inicial'],
            ['entrada_data'],
            ['entrada_hora'],
            ['km_final'],
            ['controle_frota', 'placa'],
            ['motorista', 'nome'],
            ['setor', 'nome'],
            ['relatorio_trajeto_motorista']
        ];

        $this->pdfTitles = ['Data Saída', 'Hora Saida', 'Km Saída', 'Data Entrada', 'Hora Entrada', 'KM Entrada', 'Placa', 'Motorista', 'Setor', 'Trajeto'];

        $this->indexFields = [['controle_frota', 'veiculo'], ['controle_frota', 'placa'], ['entrada_data'], ['entrada_hora'], ['nome_responsavel'], ['status']];
        $this->indexTitles = ['Motorista', 'Veículo', 'Placa', 'Data Entrada', 'Hora Entrada',  'Responsável'];

        $this->pdfindividualFields = [['controle_frota', 'veiculo'], ['motorista', 'nome'], ['km_final'],['relatorio_trajeto_motorista'],['quantidade_combustivel'],['observacao'],['nome_responsavel'],['mecanica'],['eletrica'],['funilaria'],['pintura'],['pneus'],['observacao_situacao'],['macaco'],['triangulo'],['estepe'],['extintor'],['chave_roda'],['observacao_acessorio'],['entrada_data'],['entrada_hora']];
        $this->pdfindividualTitles = ['Motorista', 'Veículo', 'km_final', 'relatorio_trajeto_motorista', 'quantidade_combustivel', 'observacao', 'nome_responsavel', 'mecanica', 'eletrica', 'funilaria', 'pintura', 'pneus', 'observacao_situacao', 'macaco', 'triangulo', 'estepe', 'extintor', 'chave_roda', 'observacao_acessorio', 'entrada_data', 'entrada_hora'];

        $this->pdfTitle = 'REGISTRO DIÁRIO DE ENTRADA, SAÍDA E TRAJETÓRIA DO VEÍCULO';

        $this->numbersWithDecimal = ['km_final'];

        $this->pdfGeralPath = 'admin/pdf/veiculoEntrada/relatorio-geral';
        $this->landscape = true;
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

        $pdf = PDF::loadView('admin/veiculo-entrada/pdf/relatorio-individual', $data);
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

        $veiculo = explode('-', $requestData['controle_frota_id']);
        $requestData['veiculo_saida_id'] = $veiculo[2];


        $dataEntrada = $this->veiculoEntradaService->verificaDataEntradaMaiorQueDataSaida($requestData);
        if ($dataEntrada == false) {
            toastr()->error("A data de entrada deve ser maior que a data de saida.");
            return redirect()->back()->withInput();
        }

        if ($veiculo[1] != ''){
            $verificaKM = $this->controleFrotumKmService->atualizaKilometragemVeiculoReserva($veiculo[1], $requestData['km_final']);
            $requestData['controle_frota_id'] = null;
            $requestData['veiculo_reserva_entrada_id'] = $veiculo[1];

            $saida = VeiculoSaida::where('veiculo_reserva_entrada_id', $veiculo[1])->first();
        } else {
            $verificaKM = $this->controleFrotumKmService->atualizaKilometragem($veiculo[0], $requestData['km_final']);
            $requestData['controle_frota_id'] = $veiculo[0];
            $requestData['veiculo_reserva_entrada_id'] = null;

            $saida = VeiculoSaida::where('controle_frota_id', $veiculo[0])->first();
        }

        if ($verificaKM !== true){
            toastr()->error("Kilometragem inicial deve ser maior que {$verificaKM}");
            return redirect()->back()->withInput();
        }

//        $saida->status = 0;
        $saida->delete();

        $create = $this->model->create($requestData);

        $this->LogModelo($create->id, 'cadastro', $this->model->getTable(), $requestData, null, $userAuth, $create->setor_id);

        return redirect($this->redirectPath)->withInput();
    }

    public function customListagem(Request $request)
    {
        $limit = $request->all()['limit'] ?? 20;
        $filters = $request->except('_token');

        $result = $this->model;
        $requestData = $request->all();

        if(isset($requestData['controle_frota_id']))
            $result = $result->where('controle_frota_id', '=', $requestData['controle_frota_id']);

        if(isset($requestData['motorista_id']))
            $result = $result->where('motorista_id', '=', $requestData['motorista_id']);

        if(isset($requestData['data_inicial']))
            $result = $result->whereDate('entrada_data', '>=', convertTimestampToBd($requestData['data_inicial'], 'Y-m-d'));

        if(isset($requestData['data_final']))
            $result = $result->whereDate('entrada_data', '<=', convertTimestampToBd($requestData['data_final'], 'Y-m-d'));

        if (\Gate::allows('isMasterOrAdmin')){
            if(isset($requestData['setor_id']))
                $result = $result->where('setor_id', '=', $requestData['setor_id']);
        } else {
            $result = $result->where('setor_id', '=', auth('api')->user()->setor_id);
        }

        $result = $result->orderBy('id', 'DESC');

        if ($request->export_pdf == "true")
            return $this->exportPdf($result);

        $result = $result->paginate($limit);

        return view($this->path.'.index', ['results'=>$result, 'request'=> $requestData, 'selectModelFields' => $this->selectModelFields(), 'fields' => $this->indexFields, 'titles' => $this->indexTitles, 'filters' => $filters]);
    }

}
