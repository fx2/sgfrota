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
        $this->pdfFields = [['data'], ['horario'], ['prioridade'], ['status']];
        $this->pdfTitles = ['Data', 'Hora', 'Prioridade', 'Status'];
        $this->indexFields = [['data'], ['horario'], ['prioridade'], ['status']];
        $this->indexTitles = ['Data', 'Hora', 'Prioridade', 'Status'];
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
        $requestData['respondendo_auth_id'] = $userAuth->id;

        $requestData['etapa'] = $result->respondendo_descricao == NULL ? 2 : 3;

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
