<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\VeiculoReservaEntrada;
use App\Services\VerificaPerfil;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;
use PDF;

class VeiculoReservaEntradaController extends Controller
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
    public function __construct(VeiculoReservaEntrada $veiculoreservaentrada)
    {

        $this->middleware('auth');
        // $this->middleware('checksetor:' . VEICULORESERVAENTRADA_VISUALIZAR, ['only' => ['index']]);
        // $this->middleware('checksetor:' . VEICULORESERVAENTRADA_ADICIONAR, ['only' => ['create']]);
        // $this->middleware('checksetor:' . VEICULORESERVAENTRADA_EDITAR, ['only' => ['edit']]);
        // $this->middleware('checksetor:' . VEICULORESERVAENTRADA_DELETAR, ['only' => ['destroy']]);
        // $this->middleware('checksetor:' . VEICULORESERVAENTRADA_RELATORIO, ['only' => ['relatorio']]);

        $this->model = $veiculoreservaentrada;
        $this->saveSetorScope = true;
        $this->path = 'admin.veiculo-reserva-entrada';
        $this->redirectPath = 'veiculo-reserva-entrada';
        $this->withFields = ['tipo_veiculoHasOne', 'tipo_combustivel', 'marca', 'modelo', 'responsavel', 'setor'];
        $this->selectModelFields = [
            'TipoVeiculo' => '\App\Models\TipoVeiculo',
            'TipoCombustivel' => '\App\Models\TipoCombustivel',
            'Marca' => '\App\Models\Marca',
            'Modelo' => '\App\Models\Modelo',
            'TipoResponsavel' => '\App\Models\TipoResponsavel',
            'Setor' => '\App\Models\Setor',
            'ControleFrotum' => '\App\Models\ControleFrotum',
        ];
        $this->joinSearch = [
            'tipo_veiculo_id' => ['nome', '\App\Models\TipoVeiculo'],
            'tipo_combustivel_id' => ['nome', '\App\Models\TipoCombustivel'],
            'marca_id' => ['nome', '\App\Models\Marca'],
            'modelo_id' => ['modelo', '\App\Models\Modelo'],
            'tipo_responsavel_id' => ['responsavel', '\App\Models\TipoResponsavel'],
            'setor' => ['setor', '\App\Models\Setor'],
        ];
        $this->fileName = ['dut', 'documento', 'foto'];
        $this->uploadFilePath = 'images/veiculo-reserva-entrada';
        $this->validations = [
            'tipo_veiculo_id' => 'required',
            'tipo_combustivel_id' => 'required',
            'marca_id' => 'required',
            'modelo_id' => 'required',
            'tipo_responsavel' => 'required',
            // 'tipo_responsavel_id' => 'required',
            'tipo_veiculo' => 'required',
            'disponivel_outros_departamentos' => 'required',
            // 'veiculo_escolar' => 'required',
            'renavan' => 'required',
            'placa' => 'required',
            'chassi' => 'required',
            'especie_tipo' => 'required',
            'veiculo' => 'required',
            'ano_fabricacao' => 'required',
            'ano_modelo' => 'required',
            'capacidade' => 'required',
            'cor' => 'required',
//            'patrimonio' => 'required',
            'estado_veiculo' => 'required',
            'km_inicial' => 'required',
            'dut' => 'required',
            'foto' => 'required',
            'status' => 'required',
        ];
        $this->indexFields = [['veiculo'], ['placa'], ['marca', 'nome'], ['modelo', 'modelo'], ['status']];
        $this->indexTitles = ['Veículo', 'Placa', 'Marca', 'Modelo', 'Status'];

        $this->pdfFields = [['placa'], ['ano_fabricacao'], ['ano_modelo'], ['modelo', 'modelo'], ['setor', 'nome'], ['tipo_veiculo']];
        $this->pdfTitles = ['Placa', 'Ano/Fab', 'Ano/Mod', 'Modelo', 'Setor', 'Tipo'];
        $this->pdfTitle = 'Entrada de Veículo Reserva';

        $this->pdfindividualFields = [['controle_frota', 'veiculo'], ['motorista', 'nome'], ['km_final'],['relatorio_trajeto_motorista'],['quantidade_combustivel'],['observacao'],['nome_responsavel'],['mecanica'],['eletrica'],['funilaria'],['pintura'],['pneus'],['observacao_situacao'],['macaco'],['triangulo'],['estepe'],['extintor'],['chave_roda'],['observacao_acessorio'],['entrada_data'],['entrada_hora']];
        $this->pdfindividualTitles = ['Motorista', 'Veículo', 'km_final', 'relatorio_trajeto_motorista', 'quantidade_combustivel', 'observacao', 'nome_responsavel', 'mecanica', 'eletrica', 'funilaria', 'pintura', 'pneus', 'observacao_situacao', 'macaco', 'triangulo', 'estepe', 'extintor', 'chave_roda', 'observacao_acessorio', 'entrada_data', 'entrada_hora'];

        $this->numbersWithDecimal = ['km_inicial']; //'km_atual' tambem
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

        $result = $result->withTrashed();

        if ($request->export_pdf == "true")
            return $this->exportPdf($result);

        $result = $result->orderBy('id', 'DESC');

        $result = $result->paginate($limit);

        return view($this->path.'.index', [
            'results'=>$result, 'fields' => $this->indexFields,
            'titles' => $this->indexTitles,
            'selectModelFields' => $this->selectModelFields()
        ]);
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

        $requestData['km_atual'] = $requestData['km_inicial'];

        $requestData['controle_frota_id'] = explode('-', $requestData['controle_frota_id'])[0];

        $create = $this->model->create($requestData);
        $this->LogModelo($create->id, 'cadastro', $this->model->getTable(), $requestData, null, $userAuth, $create->setor_id);

        return redirect($this->redirectPath)->withInput();
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

        $requestData['km_atual'] = str_replace('.', '', str_replace(',', '', $requestData['km_atual']));

        $requestData['controle_frota_id'] = explode('-', $requestData['controle_frota_id'])[0];

        $this->LogModelo($result->id, 'edição', $this->model->getTable(), $requestData,  $result, $userAuth, $result->setor_id);
        $result->update($requestData);

        $requestData['id'] = $result->id;


        return redirect($this->redirectPath)->withInput();
    }

    public function customListagem(Request $request)
    {
        $limit = $request->all()['limit'] ?? 20;

        $result = $this->model;
        $requestData = $request->all();

        if($requestData['tipo_veiculo'] !== null)
            $result = $result->where('tipo_veiculo', '=', $requestData['tipo_veiculo']);

        if($requestData['tipo_responsavel_id'] !== null)
            $result = $result->where('tipo_responsavel_id', '=', $requestData['tipo_responsavel_id']);

        if($requestData['placa'] !== null)
            $result = $result->where('placa', 'LIKE', "%$requestData[placa]%");

        if($requestData['ano_modelo'] !== null)
            $result = $result->where('ano_modelo', '=', $requestData['ano_modelo']);

        if (\Gate::allows('isMasterOrAdmin')){
            if($requestData['setor_id'] !== null)
                $result = $result->where('setor_id', '=', $requestData['setor_id']);
        } else {
            $result = $result->where('setor_id', '=', auth('api')->user()->setor_id);
        }

        if ($request->export_pdf == "true")
            return $this->exportPdf($result);

        $result = $result->withTrashed();

        $result = $result->paginate($limit);

        return view($this->path.'.index', ['results'=>$result, 'request'=> $requestData, 'selectModelFields' => $this->selectModelFields(), 'fields' => $this->indexFields, 'titles' => $this->indexTitles]);
    }

    public function show($id)
    {
        $result = $this->model
          ->where('id', '=', $id)->withTrashed()->first();

        return view('admin.veiculo-reserva-entrada.show', ['result'=>$result, 'withFields' => $this->withFields($result), 'selectModelFields' => $this->selectModelFields()]);
    }

    public function customShowPdf($id)
    {
        $result = $this->model::where('id', $id)->withTrashed()->first();

        $data = [
            'results' => $result,
            'fields' => $this->pdfindividualFields,
            'titles' => $this->pdfindividualTitles,
            'pdfTitle' => $this->pdfTitle
        ];

        $pdf = PDF::loadView('admin/veiculo-reserva-entrada/pdf/relatorio-individual', $data);
        $pdfModelName = str_replace("admin.", "", $this->path); // TODO: mexer nesse admin. caso mude a pasta

        // return $pdf->download($pdfModelName . '.pdf');
        return $pdf->stream($pdfModelName . '.pdf');
    }
}
