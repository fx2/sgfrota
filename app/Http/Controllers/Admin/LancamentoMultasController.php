<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\LancamentoMulta;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class LancamentoMultasController extends Controller
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
    public function __construct(LancamentoMulta $lancamentomultas)
    {
        $this->middleware('auth');
        // $this->middleware('checksetor:' . LANCAMENTODEMULTAS_VISUALIZAR, ['only' => ['index']]);
        // $this->middleware('checksetor:' . LANCAMENTODEMULTAS_ADICIONAR, ['only' => ['create']]);
        // $this->middleware('checksetor:' . LANCAMENTODEMULTAS_EDITAR, ['only' => ['edit']]);
        // $this->middleware('checksetor:' . LANCAMENTODEMULTAS_DELETAR, ['only' => ['destroy']]);
        // $this->middleware('checksetor:' . LANCAMENTODEMULTAS_RELATORIO, ['only' => ['relatorio']]);
        $this->model = $lancamentomultas;
        $this->saveSetorScope = true;
        $this->path = 'admin.lancamento-multas';
        $this->redirectPath = 'lancamento-multas';
        $this->withFields = ['motorista', 'controle_frota', 'tipo_multa', 'cities', 'state'];
        $this->selectModelFields = [
            'Motoristum' => '\App\Models\Motoristum',
            'ControleFrotum' => '\App\Models\ControleFrotum',
            'TipoMulta' => '\App\Models\TipoMulta',
            'Setor' => '\App\Models\Setor',
            'State' => '\App\Models\State',
            'City' => '\App\Models\City',
        ];
        $this->joinSearch = [
            'motorista_id' => ['nome', '\App\Models\Motoristum'],
            'controle_frota_id' => ['controle_frota', '\App\Models\ControleFrotum'],
            'tipo_multa_id' => ['tipo', '\App\Models\TipoMulta'],
            'setor_id' => ['setor', '\App\Models\Setor'],
            'state_id' => ['state', '\App\Models\State'],
            'city_id' => ['cities', '\App\Models\City'],
        ];
        $this->fileName = ['foto_multa', 'boleto_pagamento', 'comprovante_pagamento'];
        $this->uploadFilePath = 'images/lancamento-multas';
        $this->validations = [
            'motorista_id' => 'required',
            'controle_frota_id' => 'required',
            'tipo_multa_id' => 'required',
            'estado_id' => 'required',
            'municipio_id' => 'required',
            'endereco_multa' => 'required',
            'numero_ait' => 'required',
            'ocorrencias' => 'required',
            'data_multa' => 'required',
            'hora_multa' => 'required',
            'orgao_correspondente' => 'required',
            'enquadramento' => 'required',
//            'data_vencimento' => 'required',
            'valor_multa' => 'required',
            'pago' => 'required',
            'foto_multa' => 'required',
            'status' => 'required',
        ];

        $this->indexFields = [['motorista', 'nome'], ['data_vencimento'], ['controle_frota', 'veiculo'], ['tipo_multa', 'tipo'], ['numero_ait']];
        $this->indexTitles = ['Motorista', 'Data Venc', 'Veículo', 'Tipo', 'N° AIT'];

        $this->pdfFields = [['data_multa'], ['hora_multa'], ['motorista', 'nome'], ['controle_frota', 'placa'],
            ['setor', 'nome'],
            ['cities', 'nome'], // MUNICIPIO
            ['tipo_multa', 'codigo'], ['pago'], ['valor_multa'], ['observacao']
        ];
        $this->pdfTitles = ['Data da Multa', 'Horário', 'Motorista', 'Veículo', 'Setor', 'Município', 'Tipo da Multa', 'Pago', 'Valor R$', 'Observação'];

        $this->pdfTitle = 'Lançamento de Multas';

        $this->numbersWithDecimal = ['valor_multa'];
    }

    public function customListagem(Request $request)
    {
        $limit = $request->all()['limit'] ?? 20;

        $result = $this->model;
        $requestData = $request->all();

        if($requestData['motorista_id'] !== null)
            $result = $result->where('motorista_id', '=', $requestData['motorista_id']);

        if($requestData['controle_frota_id'] !== null)
            $result = $result->where('controle_frota_id', '=', $requestData['controle_frota_id']);

        if($requestData['numero_ait'] !== null)
            $result = $result->where('numero_ait', '=', $requestData['numero_ait']);

        if($requestData['data_inicial'] !== null)
            $result = $result->whereDate('data', '>=', convertTimestampToBd($requestData['data_inicial'], 'Y-m-d'));

        if($requestData['data_final'] !== null)
            $result = $result->whereDate('data', '<=', convertTimestampToBd($requestData['data_final'], 'Y-m-d'));

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
