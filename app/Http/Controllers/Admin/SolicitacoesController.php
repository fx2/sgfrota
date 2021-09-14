<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Solicitaco;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class SolicitacoesController extends Controller
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
    public function __construct(Solicitaco $solicitacoes)
    {
        $this->middleware('auth');
        $this->middleware('checksetor:' . SOLICITACOES_VISUALIZAR, ['only' => ['index']]);
        $this->middleware('checksetor:' . SOLICITACOES_ADICIONAR, ['only' => ['create']]);
        $this->middleware('checksetor:' . SOLICITACOES_EDITAR, ['only' => ['edit']]);
        $this->middleware('checksetor:' . SOLICITACOES_DELETAR, ['only' => ['destroy']]);
        $this->middleware('checksetor:' . SOLICITACOES_RELATORIO, ['only' => ['relatorio']]);

        $this->model = $solicitacoes;
        $this->path = 'admin.solicitacoes';
        $this->redirectPath = 'solicitacoes';
        $this->saveSetorScope = true;
        
        $this->withFields = ['setor', 'tipoSolicitacao'];
        $this->selectModelFields = [
            'Setor' => '\App\Models\Setor',
            // 'userAuth' => '\App\Models\User',
            // 'respondendoUserAuth' => '\App\Models\User',
            'tipoSolicitacao' => '\App\Models\TipoSolicitacao',
        ];
        $this->joinSearch = [
            'setor_id' => ['setor', '\App\Models\Setor'],
            // 'auth_id' => ['nome', '\App\Models\User'],
            // 'respondendo_auth_id' => ['nome', '\App\Models\User'],
            'solicitacao_id' => ['nome', '\App\Models\TipoSolicitacao'],
        ];
        
        $this->fileName = ['documento', 'respondendo_documento'];
        $this->uploadFilePath = 'images/solicitacoes';
        $this->validations = [];
        $this->pdfFields = [['data'], ['horario'], ['prioridade'], ['respondendo_data'], ['respondendo_horario'], ['status']];
        $this->pdfTitles = ['Data Abertura', 'Hora Abertura', 'Prioridade', 'Data Respondida', 'Horário Respondido','Status'];
        $this->pdfTitle = 'Solicitação';
        $this->indexFields = [['data'], ['horario'], ['prioridade'], ['respondendo_data'], ['respondendo_horario'], ['status']];
        $this->indexTitles = ['Data Abertura', 'Hora Abertura', 'Prioridade', 'Data Respondida', 'Horário Respondido', 'Status'];
    }

    public function customListagem(Request $request)
    {
        $limit = $request->all()['limit'] ?? 20;

        $result = $this->model;
        $requestData = $request->all();

        if($requestData['prioridade'] !== null)
            $result = $result->where('prioridade', '=', $requestData['prioridade']);

        if($requestData['solicitacao_id'] !== null)
            $result = $result->where('solicitacao_id', '=', $requestData['solicitacao_id']);

        if($requestData['status'] !== null)
            $result = $result->where('status', '=', $requestData['status']);

        if($requestData['data_inicial'] !== null)
            $result = $result->whereDate('respondendo_data', '>=', convertTimestampToBd($requestData['data_inicial'], 'Y-m-d'));

        if($requestData['data_final'] !== null)
            $result = $result->whereDate('respondendo_data', '<=', convertTimestampToBd($requestData['data_final'], 'Y-m-d'));

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

    public function create()
    {
        $id = $this->model::orderBy('id', 'desc')->first()['id'] ?? 0;
        $sequencial = $id + 1 . '/' .date('Y');
        $data = date('Y-m-d');
        $horario = date('H:i');

        return view($this->path.'.create', [
            'selectModelFields' => $this->selectModelFields(), 
            'sequencial' => $sequencial,
            'data' => $data,
            'horario' => $horario,
        ]);
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

        if ($userAuth->id != $result['auth_id']){
            $requestData['respondendo_auth_id'] = $userAuth->id;
            $requestData['respondendo_data'] = date('Y-m-d');
            $requestData['respondendo_horario'] = date('H:i:s');
            $requestData['etapa'] = 2;
        }

        if ($result['respondendo_descricao'] && $userAuth->id == $result['auth_id']){
            $requestData['status'] = 0;
            $requestData['etapa'] = 3;
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

        $this->LogModelo($result->id, 'edição', $this->model->getTable(), $requestData,  $result, $userAuth, $result->setor_id);

        $result->update($requestData);

        $requestData['id'] = $result->id;

        return redirect($this->redirectPath)->withInput();
    }
}
