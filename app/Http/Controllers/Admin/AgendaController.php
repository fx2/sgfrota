<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class AgendaController extends Controller
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
    public function __construct(Agenda $agenda)
    {
        $this->middleware('auth');
        // $this->middleware('checksetor:' . AGENDA_VISUALIZAR, ['only' => ['index']]);
        // $this->middleware('checksetor:' . AGENDA_ADICIONAR, ['only' => ['create']]);
        // $this->middleware('checksetor:' . AGENDA_EDITAR, ['only' => ['edit']]);
        // $this->middleware('checksetor:' . AGENDA_DELETAR, ['only' => ['destroy']]);
        // $this->middleware('checksetor:' . AGENDA_RELATORIO, ['only' => ['relatorio']]);

        $this->model = $agenda;
        $this->path = 'admin.agenda';
        $this->redirectPath = 'agenda';
        $this->withFields = ['setor'];
        $this->selectModelFields = [
            'Setor' => '\App\Models\Setor',
        ];
        $this->joinSearch = [
            'auth_id' => ['auth', '\App\Models\User'],
            'setor_id' => ['setor', '\App\Models\Setor'],
        ];
        $this->fileName = [];
        $this->uploadFilePath = 'images/agenda';
        $this->validations = [];
        $this->pdfFields = [['id']];
        $this->pdfTitles = ['Id'];
        $this->indexFields = [['id']];
        $this->indexTitles = ['Id'];

        $this->saveSetorScope = true;
    }


    public function customIndex(Request $request)
    {
        $findAgendamentos = Agenda::selectRaw(
            "id as fkas_id,
            titulo as title,
            titulo,
            descricao,
            data,
            horario,
            data as start,
            data as end,
            setor_id,
            auth_id"
        )->where('status', 1)
        ->whereYear('created_at', date('Y'))
        ->get();

        $agendamentos = [];
        foreach ($findAgendamentos as $key => $value) {
            $agendamentos[$key] = $value;
            $agendamentos[$key]['color'] = 'orange';

            if ($value->auth_id == auth()->user()->id)
                $agendamentos[$key]['color'] = 'green';
        }

        return view($this->path.'.custom-index', [
            'agendamentos' => $agendamentos,
            'selectModelFields' => $this->selectModelFields()]);
    }

    public function customStore(Request $request) {
        $requestData = $request->all();

        $startDate = $requestData['range']['start'];

        $findAgendamentos = DB::select("select * from agendas WHERE '$startDate' BETWEEN previsao_saida AND previsao_volta");

        return $findAgendamentos;
    }

    public function store(Request $request) {
        $userAuth = auth('api')->user();
        $requestData = $request->all();
        $requestData['auth_id'] = $userAuth->id;

        if ($this->saveSetorScope){
            if ($userAuth->type !== 'master' AND $userAuth->type !== 'admin')
                $requestData['setor_id'] = $userAuth->setor_id;
        }

        $create = $this->model->create($requestData);

        $this->LogModelo($create->id, 'cadastro', $this->model->getTable(), $requestData, null, $userAuth, $create->setor_id);

        return redirect()->back();
    }

    public function customDestroy($id)
    {
        $a = 1;
        dd($id, 'top');
    }
}
