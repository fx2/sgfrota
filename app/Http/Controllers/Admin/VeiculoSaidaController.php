<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\ControleFrotum;
use App\Models\Motoristum;
use App\Models\VeiculoSaida;
use App\Services\VeiculoSaidaService;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;
use App\Services\VerificaPerfil;

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
        $this->pdfFields = [['motorista', 'nome'], ['controle_frota', 'veiculo'], ['nome_responsavel']];
        $this->pdfTitles = ['Motorista', 'Veículo', 'Responsável'];
        $this->indexFields = [['motorista', 'nome'], ['controle_frota', 'veiculo'], ['saida_data'], ['saida_hora'], ['nome_responsavel']];
        $this->indexTitles = ['Motorista', 'Veículo', 'Saida Data', 'Saida Hora', 'Responsável'];

        $this->numbersWithDecimal = ['km_inicial'];
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
        $result = $this->model
          ->where('id', '=', $id)->withTrashed()->first();

        $controleFrotumDisponiveis = $this->veiculoSaidaService->veiculosDisponiveisSaida($result->controle_frota_id);

        return view($this->path.'.edit', ['result' => $result, 'selectModelFields' => $this->selectModelFields(), 'controleFrotumDisponiveis' => $controleFrotumDisponiveis]);
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
