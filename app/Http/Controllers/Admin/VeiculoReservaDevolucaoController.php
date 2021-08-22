<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\VeiculoReservaEntrada;
use App\Services\VerificaPerfil;
use App\Traits\CrudControllerTrait;
use Illuminate\Http\Request;

class VeiculoReservaDevolucaoController extends Controller
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
    public function __construct(VeiculoReservaEntrada $veiculoReservaEntrada)
    {
        $this->middleware('auth');
        $this->model = $veiculoReservaEntrada;
        $this->saveSetorScope = true;
        $this->path = 'admin.veiculo-reserva-devolucao';
        $this->redirectPath = 'veiculo-reserva-devolucao';
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
        $this->fileName = ['dut', 'certificado_vistoria', 'foto'];
        $this->uploadFilePath = 'images/veiculo-reserva-devolucao';
        $this->validations = [

        ];
        $this->indexFields = [['veiculo'], ['placa'], ['marca', 'nome'], ['modelo', 'modelo'], ['responsavel', 'nome'], ['status']];
        $this->indexTitles = ['Veículo', 'Placa', 'Marca', 'Modelo', 'Responsável', 'Status'];

        $this->pdfFields = [['placa'], ['ano_fabricacao'], ['ano_modelo'], ['modelo', 'modelo'], ['responsavel', 'nome'], ['setor', 'nome'], ['tipo_veiculo']];
        $this->pdfTitles = ['Placa', 'Ano/Fab', 'Ano/Mod', 'Modelo', 'Responsável', 'Setor', 'Tipo'];
        $this->pdfTitle = 'Controle de Frotas';
        $this->numbersWithDecimal = ['km_inicial', 'entrada_km_atual']; //'km_atual' tambem
    }

    /**
     * Display a listing of the resource.
     * ?limit=20
     * ?order=title,asc
     * ?field=value -> where
     * ?like=field,value
     * ?where=field,condition,value
     *
     * @return \Illuminate\Http\Response
     */
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

        if ($request->export_pdf == "true")
            return $this->exportPdf($result);

        $result = $result->withTrashed();
        $result = $result->orderBy('id', 'DESC');

        $result = $result->paginate($limit);

        return view($this->path.'.index', [
            'results'=>$result, 'fields' => $this->indexFields,
            'titles' => $this->indexTitles,
            'selectModelFields' => $this->selectModelFields()
        ]);
    }

    public function update(Request $request, $id)
    {
        $userAuth = auth('api')->user();

        $requestToUpdate = [];

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
            if ($userAuth->type !== 'master' AND $userAuth->type !== 'admin'){
                $requestData['setor_id'] = $userAuth->setor_id;
                $requestToUpdate['setor_id'] = $requestData['setor_id'];
            }
        }

        if (!empty($this->checkboxExplode)) {
            $requestData = $this->saveCheckboxExplode($requestData);
        }

        if (!empty($this->fileName)) {
            $requestData = $this->eachFiles($requestData, $request);
        }

        $requestToUpdate['devolucao_data'] = $requestData['devolucao_data'];
        $requestToUpdate['devolucao_horario'] = $requestData['devolucao_horario'];
        $requestToUpdate['devolucao_km_atual'] = $requestData['devolucao_km_atual'] = str_replace('.', '', str_replace(',', '', $requestData['devolucao_km_atual']));
        $requestToUpdate['devolucao_combustivel'] = $requestData['devolucao_combustivel'];
        $requestToUpdate['devolucao_recebido_por'] = $requestData['devolucao_recebido_por'];
        $requestToUpdate['devolucao_observacao'] = $requestData['devolucao_observacao'];
        $requestToUpdate['auth_id'] = $requestData['auth_id'];

        $requestToUpdate['tipo'] = VeiculoReservaEntrada::TIPO_DEVOLUCAO;

        $result->update($requestToUpdate);

        $result->delete();

        $requestData['id'] = $result->id;
        $this->LogModelo($result->id, 'edição', $this->model->getTable(), $requestData,  $result, $userAuth, $result->setor_id);

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

    public function customShow($id)
    {
        return 'ovo';
    }
}