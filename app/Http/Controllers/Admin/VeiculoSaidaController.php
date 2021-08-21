<?php

namespace App\Http\Controllers\Admin;

use App\CustomValidations\VeiculoSaidaKmInicialValidation;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\ControleFrotum;
use App\Models\Motoristum;
use App\Models\VeiculoSaida;
use App\Services\ControleFrotumKmService;
use App\Services\VeiculoSaidaService;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;
use App\Services\VerificaPerfil;
use PDF;

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
     * @var ControleFrotumKmService $controleFrotumKmService
     */
    private $controleFrotumKmService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        VeiculoSaida $veiculosaida,
        VeiculoSaidaService $veiculoSaidaService,
        VeiculoSaidaKmInicialValidation $veiculoSaidaKmInicialValidation,
        ControleFrotumKmService $controleFrotumKmService
    )
    {
        $this->middleware('auth');

        $this->veiculoSaidaService = $veiculoSaidaService;
        $this->controleFrotumKmService = $controleFrotumKmService;

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
            'saida_data' => 'required',
            'saida_hora' => 'required',
            'status' => 'required',
        ];
        $this->pdfFields = [['saida_data'], ['saida_hora'], ['km_inicial'], ['motorista', 'nome'], ['controle_frota', 'veiculo'], ['nome_responsavel']];
        $this->pdfTitles = ['Data', 'Horário', 'KM', 'Motorista', 'Veículo', 'Responsável'];

        $this->indexFields = [['motorista', 'nome'], ['controle_frota', 'veiculo'], ['controle_frota', 'placa'], ['saida_data'], ['saida_hora'], ['nome_responsavel']];
        $this->indexTitles = ['Motorista', 'Veículo', 'Placa', 'Saida Data', 'Saida Hora', 'Responsável'];

        $this->pdfindividualFields = [['controle_frota', 'veiculo'], ['motorista', 'nome'], ['nome_responsavel'], ['km_inicial'],['quantidade_combustivel'],['mecanica'],['eletrica'],['funilaria'],['pintura'],['pneus'],['observacao_situacao'],['macaco'],['triangulo'],['estepe'],['extintor'],['chave_roda'],['observacao_acessorio'],['saida_data'],['saida_hora']];
        $this->pdfindividualTitles = ['Motorista', 'Veículo', 'Responsável', 'km_inicial', 'quantidade_combustivel', 'mecanica', 'eletrica', 'funilaria', 'pintura', 'pneus', 'observacao_situacao', 'macaco', 'triangulo', 'estepe', 'extintor', 'chave_roda', 'observacao_acessorio', 'saida_data', 'saida_hora'];
        $this->pdfTitle = 'REGISTRO DIÁRIO DE SAÍDA E TRAJETÓRIA DO VEÍCULO ';

        $this->numbersWithDecimal = ['km_inicial'];

//        $this->plusValidationStore = ['Erro inicial' => $veiculoSaidaKmInicialValidation->verifyKmInicial(), 'erro final ' => $veiculoSaidaKmInicialValidation->testeLower()];
    }

    public function create()
    {
        $id = $this->model::orderBy('id', 'desc')->first()['id'] ?? 0;
        $sequencial = $id + 1 . '/' .date('Y');

        $controleFrotumDisponiveis = $this->veiculoSaidaService->veiculosDisponiveisSaida();

        return view($this->path.'.create', ['selectModelFields' => $this->selectModelFields(), 'sequencial' => $sequencial, 'controleFrotumDisponiveis' => $controleFrotumDisponiveis]);
    }

    public function store(Request $request)
    {
        $userAuth = auth('api')->user();

        if (!empty($this->validations)) {
            $this->validate($request, $this->validations);
        }

        if (!empty($this->plusValidationStore)) { // se tiver algum falso, retorna erro
            foreach ($this->plusValidationStore as $key => $value){
                if ($value === false){
                    toastr()->error($key);
                    return redirect()->back()->withInput();
                }
            }
        }

        $requestData = $request->all();
        $requestData['auth_id'] = $userAuth->id;

        $veiculo = explode('-', $requestData['controle_frota_id']);
        if ($veiculo[1] != ''){
            $verificaKM = true;
            $requestData['controle_frota_id'] = null;
            $requestData['veiculo_reserva_entrada_id'] = $veiculo[1];
        } else {
            $verificaKM = $this->controleFrotumKmService->atualizaKilometragem($veiculo[0], $requestData['km_inicial']);
            $requestData['controle_frota_id'] = $veiculo[0];
            $requestData['veiculo_reserva_entrada_id'] = null;
        }

        if ($verificaKM !== true){
            toastr()->error("Kilometragem inicial deve ser maior que {$verificaKM}");
            return redirect()->back()->withInput();
        }

        if ($this->saveSetorScope){
            if ($userAuth->type !== 'master' AND $userAuth->type !== 'admin')
                $requestData['setor_id'] = $userAuth->setor_id;
        }

        if (!empty($this->checkboxExplode)) {
            $requestData = $this->saveCheckboxExplode($requestData);
        }

        if (!empty($this->fileName)) {
            $requestData = $this->eachFiles($requestData, $request);
        }

        if (!empty($this->numbersWithDecimal)) {
            $requestData = $this->formatRemoveDecimal($requestData);
        }

        $create = $this->model->create($requestData);
        $this->LogModelo($create->id, 'cadastro', $this->model->getTable(), $requestData, null, $userAuth, $create->setor_id);

        return redirect($this->redirectPath)->withInput();
    }

    public function edit($id)
    {
        $result = $this->model
          ->where('id', '=', $id)->first();

        $controleFrotumDisponiveis = $this->veiculoSaidaService->veiculosDisponiveisSaida($result);

        return view($this->path.'.edit', ['result' => $result, 'selectModelFields' => $this->selectModelFields(), 'controleFrotumDisponiveis' => $controleFrotumDisponiveis]);
    }

    public function update(Request $request, $id)
    {
        $userAuth = auth('api')->user();

        if (!empty($this->validations)) {
            foreach ($this->fileName as $key => $value) {
                unset($this->validations[$value]);
            }

            $this->validate($request, $this->validations);
        }

        $result = $this->model->findOrFail($id);
        $requestData = $request->all();
        $requestData['auth_id'] = $userAuth->id;

        if ($this->saveSetorScope){
            if ($userAuth->type !== 'master' AND $userAuth->type !== 'admin')
                $requestData['setor_id'] = $userAuth->setor_id;
        }

        if (!empty($this->checkboxExplode)) {
            $requestData = $this->saveCheckboxExplode($requestData);
        }

        if (!empty($this->fileName)) {
            $requestData = $this->eachFiles($requestData, $request);
        }

        if (!empty($this->numbersWithDecimal)) {
            $requestData = $this->formatRemoveDecimal($requestData);
        }

        $result->update($requestData);

        $verificaKM = $this->controleFrotumKmService->atualizaKilometragem($requestData['controle_frota_id'], $requestData['km_inicial']);
        if ($verificaKM !== true){
            toastr()->error("Kilometragem inicial deve ser maior que {$verificaKM}");
            return redirect()->back()->withInput();
        }

        $requestData['id'] = $result->id;
        $this->LogModelo($result->id, 'edição', $this->model->getTable(), $requestData,  $result, $userAuth, $result->setor_id);

        return redirect($this->redirectPath)->withInput();
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

        $pdf = PDF::loadView('admin/veiculo-saida/pdf/relatorio-individual', $data);
        $pdfModelName = str_replace("admin.", "", $this->path); // TODO: mexer nesse admin. caso mude a pasta

        // return $pdf->download($pdfModelName . '.pdf');
        return $pdf->stream($pdfModelName . '.pdf');
    }

    public function index(Request $request)
    {
        $verificaPerfil = new VerificaPerfil;

        $limit = $request->all()['limit'] ?? 20;

        $result = $this->model;

        if (!$this->verifyIfHasMasterOrAdminPermission($verificaPerfil, $request))
            return redirect()->back();

        if (isset($request->all()['select'])) {
            $result = $this->select($request->all()['select'], $result);
        }

        if ($verificaPerfil->isMasterOrAdmin() && in_array("setor_id", $result->getModel()->getFillable())){
            $result = $this->with('setor', $result);
        }

        if (isset($request->all()['order'])) {
            $result = $this->order($request->all()['order'], $result);
        }

        if (isset($request->all()['join'])) {
            $result = $this->join($request->all()['join'], $result);
        }

        if (isset($request->all()['leftJoin'])) {
            $result = $this->leftJoin($request->all()['leftJoin'], $result);
        }

        if (isset($request->all()['rightJoin'])) {
            $result = $this->rightJoin($request->all()['rightJoin'], $result);
        }

        if (isset($request->all()['like'])) {
            $result = $this->like($request->all()['like'], $result);
        }

        if(isset($request->all()['with'])) {
            $result = $this->with($request->all()['with'], $result);
        }

        if(isset($request->all()['groupBy'])) {
            $result = $this->groupBy($request->all()['groupBy'], $result);
        }

        $result= $result->with($this->relationships());

        if(isset($request->all()['where'])) {
            $result = $this->where($request->all()['where'], $result);
        }

        if(isset($request->all()['orWhere'])) {
            $result = $this->orWhere($request->all()['orWhere'], $result);
        }

        if(isset($request->all()['search'])) {
            $result = $this->search($request->search, $result);
        }

        if(isset($request->all()['get'])) {
            return $result->get();
        }

        if(isset($request->all()['first'])) {
            return $result->first();
        }

        $result = $result->orderBy('deleted_at')->withTrashed();

        if ($request->export_pdf == "true")
            return $this->exportPdf($result);

        $result = $result->where('status', '!=', 0);

        $result = $result->orderBy('id', 'DESC');

        $result = $result->paginate($limit);

        return view($this->path.'.index', [
            'results'=>$result, 'fields' => $this->indexFields,
            'titles' => $this->indexTitles,
            'selectModelFields' => $this->selectModelFields()
        ]);
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

        $result = $result->orderBy('deleted_at')->withTrashed();

        if ($request->export_pdf == "true")
            return $this->exportPdf($result);

        $result = $result->paginate($limit);

        return view($this->path.'.index', ['results'=>$result, 'request'=> $requestData, 'selectModelFields' => $this->selectModelFields(), 'fields' => $this->indexFields, 'titles' => $this->indexTitles]);
    }

    public function show($id)
    {
         $result = $this->model
          ->where('id', '=', $id)->withTrashed()->first();

        $controleFrotumDisponiveis = $this->veiculoSaidaService->veiculosDisponiveisSaida($result->controle_frota_id);

        return view($this->path.'.show', ['result' => $result, 'selectModelFields' => $this->selectModelFields(), 'controleFrotumDisponiveis' => $controleFrotumDisponiveis]);
    }

    public function customShow($id)
    {
         $resp = VeiculoSaida::where('controle_frota_id', '=', $id)->first();

         $moto = Motoristum::where('id', '=', $resp->motorista_id)->first();

        return $moto;
    }

    public function destroy($id)
    {
        $userAuth = auth('api')->user();

        $result = $this->model->where('id', '=', $id)->withTrashed()->first();
        $result->status = 0;
        $result->deleted_at = date("Y-m-d H:i:s");
        $result->save();

        $this->LogModelo($result->id, 'deletou', $this->model->getTable(), $result,  null, $userAuth, $result->setor_id);

        return json_encode(true);
    }

}
