<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\ControleFrotum;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class ControleFrotaController extends Controller
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
    public function __construct(ControleFrotum $controlefrota)
    {
        $this->middleware('auth');
        //$this->middleware('checksetor:' . CONTROLEDEFROTAS_VISUALIZAR, ['only' => ['index']]);
        //$this->middleware('checksetor:' . CONTROLEDEFROTAS_ADICIONAR, ['only' => ['create']]);
        //$this->middleware('checksetor:' . CONTROLEDEFROTAS_EDITAR, ['only' => ['edit']]);
        //$this->middleware('checksetor:' . CONTROLEDEFROTAS_DELETAR, ['only' => ['destroy']]);
        //$this->middleware('checksetor:' . CONTROLEDEFROTAS_RELATORIO, ['only' => ['relatorio']]);

        $this->model = $controlefrota;
        $this->saveSetorScope = true;
        $this->path = 'admin.controle-frota';
        $this->redirectPath = 'controle-frota';
        $this->withFields = ['tipo_veiculoHasOne', 'tipo_combustivel', 'marca', 'modelo', 'responsavel', 'setor'];
        $this->selectModelFields = [
            'TipoVeiculo' => '\App\Models\TipoVeiculo',
            'TipoCombustivel' => '\App\Models\TipoCombustivel',
            'Marca' => '\App\Models\Marca',
            'Modelo' => '\App\Models\Modelo',
            'TipoResponsavel' => '\App\Models\TipoResponsavel',
            'Setor' => '\App\Models\Setor',
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
        $this->uploadFilePath = 'images/controle-frota';
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
        $this->indexFields = [['veiculo'], ['placa'], ['marca', 'nome'], ['modelo', 'modelo'],
            // ['responsavel', 'nome'],
            ['status']];
        $this->indexTitles = ['Veículo', 'Placa', 'Marca', 'Modelo',
            // 'Responsável',
            'Status'];

        $this->pdfFields = [['placa'], ['ano_fabricacao'], ['ano_modelo'], ['modelo', 'modelo'],
            // ['responsavel', 'nome'],
            ['setor', 'nome'], ['tipo_veiculo']];
        $this->pdfTitles = ['Placa', 'Ano/Fab', 'Ano/Mod', 'Modelo',
            // 'Responsável',
            'Setor', 'Tipo'];
        $this->pdfTitle = 'Controle de Frotas';
        $this->numbersWithDecimal = ['km_inicial', 'revisao_com_km']; //'km_atual' tambem

    }

    public function store(Request $request)
    {
        $userAuth = auth('api')->user();

        if (!empty($this->validations)) {
            $this->validate($request, $this->validations);
        }

        if(!$this->model->validaPlaca($request->placa)){
            toastr()->error('Placa já está sendo usado por outro veículo.');
            return redirect()->back()->withInput();
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

        if(!$this->model->validaPlaca($request->placa, $id)){
            toastr()->error('Placa já está sendo usado por outro veículo.');
            return redirect()->back()->withInput();
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

        $result->update($requestData);

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

        $result = $result->paginate($limit);

        return view($this->path.'.index', ['results'=>$result, 'request'=> $requestData, 'selectModelFields' => $this->selectModelFields(), 'fields' => $this->indexFields, 'titles' => $this->indexTitles]);
    }
}
