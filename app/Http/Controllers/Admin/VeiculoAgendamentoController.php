<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\ControleFrotum;
use App\Models\VeiculoAgendamento;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;
use Illuminate\Support\Facades\DB;

class VeiculoAgendamentoController extends Controller
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
    public function __construct(VeiculoAgendamento $veiculoagendamento)
    {
        $this->middleware('auth');
        $this->model = $veiculoagendamento;
        $this->saveSetorScope = true;
        $this->path = 'admin.veiculo-agendamento';
        $this->redirectPath = 'veiculo-agendamento';
        $this->withFields = ['controle_frota'];
        $this->selectModelFields = [
            'ControleFrotum' => '\App\Models\ControleFrotum',
            'Setor' => '\App\Models\Setor',
        ];
        $this->joinSearch = [
            'controle_frota_id' => ['controle_frota', '\App\Models\ControleFrotum'],
            'auth_id' => ['auth', '\App\Models\User'],
            'setor_id' => ['setor', '\App\Models\Setor'],
        ];
        $this->fileName = [];
        $this->uploadFilePath = 'images/veiculo-agendamento';
        $this->validations = [];
        $this->pdfFields = [['controle_frota', 'veiculo'],['auth', 'name'], ['periodo'], ['previsao_saida'],['previsao_volta']];
        $this->pdfTitles = ['Veículo', 'Locatário', 'Período', 'Saida', 'Volta'];
        $this->indexFields = [['controle_frota', 'veiculo'],['auth', 'name'], ['periodo'],['previsao_saida'],['previsao_volta']];
        $this->indexTitles = ['Veículo', 'Locatário', 'Período', 'Saida', 'Volta'];

        $this->pdfTitle = 'Agendamentos';
    }

    public function customIndex(Request $request)
    {
        $veiculos = ControleFrotum::where([
            ['disponivel_outros_departamentos', 1],
            ['status', 1]
        ])->get();

        $findAgendamentos = VeiculoAgendamento::selectRaw(
            "id AS fkas_id, auth_id,
            CONCAT(' - ', periodo,' - ', DATE_FORMAT(previsao_volta, '%H:%i')) AS title,
            DATE_FORMAT(previsao_saida, '%H:%i') AS saida,
            DATE_FORMAT(previsao_volta, '%H:%i') AS volta,
            previsao_saida AS start,previsao_volta AS end,
            local,
            telefone,
            controle_frota_id"
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
            'veiculos' => $veiculos,
            'selectModelFields' => $this->selectModelFields()]);
    }

    public function customStore(Request $request) {
        $requestData = $request->all();
        // $findAgendamentos = VeiculoAgendamento::whereDate('previsao_saida', '>=', $requestData['range']['start'])
        //     ->whereDate('previsao_saida', '<=', $requestData['range']['end'])
        //     ->get();

        $startDate = $requestData['range']['start'];

        $findAgendamentos = DB::select("select * from veiculo_agendamentos WHERE '$startDate' BETWEEN previsao_saida AND previsao_volta");

        return $findAgendamentos;
        dd($requestData['range']['start'], $requestData['range']['end'], $findAgendamentos);
    }

    public function store(Request $request) {
        $userAuth = auth('api')->user();
        $requestData = $request->all();

        if ($this->saveSetorScope){
            if ($userAuth->type !== 'master' AND $userAuth->type !== 'admin')
                $requestData['setor_id'] = $userAuth->setor_id;
        }

        $from = date($requestData['previsao_saida']);
        $to = date('Y-m-d', strtotime("-1 day", strtotime($requestData['previsao_volta'])));

        $requestData['status'] = 1;
        $requestData['auth_id'] = auth()->user()->id;
        $requestData['previsao_saida'] =  $from . ' ' . $requestData['previsao_saida_hora'];

        $requestData['previsao_volta'] =  $to . ' ' . $requestData['previsao_volta_hora'];


        $volta = (int) convertDateTimeToSeconds($requestData['previsao_volta']);
        $saida = (int) convertDateTimeToSeconds($requestData['previsao_saida']);

        if ($saida > $volta)
            toastr()->error('A saida não pode ser maior que a volta');


        $buscaAgendamento = VeiculoAgendamento::select('periodo')->whereDate('previsao_saida', $from)->get();

        if (count($buscaAgendamento) > 1) {
            toastr()->error('Não é possível alugar o veículo neste dia.');
            return redirect()->back();
        }

        $periodo = '';
        if (isset($buscaAgendamento[0])) {
            $periodo = $buscaAgendamento[0]->periodo;
        }

        if ($periodo == 'integral') {
            toastr()->error('Não é possível alugar o veículo neste dia.');
            return redirect()->back();
        }

        if (count($buscaAgendamento) == 1 AND $requestData['periodo'] == 'integral') {
            toastr()->error('Não é possível alugar o veículo em horário integral.');
            return redirect()->back();
        }

        if ($periodo == $requestData['periodo']) {
            toastr()->error('Não é possível alugar o veículo neste horário.');
            return redirect()->back();
        }

        $create = $this->model->create($requestData);

        $this->LogModelo($create->id, 'cadastro', $this->model->getTable(), $requestData, null, $userAuth, $create->setor_id);


        return redirect()->back();
    }

}
