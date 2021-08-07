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
        $this->model = $lancamentomultas;
        $this->saveSetorScope = true;
        $this->path = 'admin.lancamento-multas';
        $this->redirectPath = 'lancamento-multas';
        $this->withFields = ['motorista', 'controle_frota', 'tipo_multa'];
        $this->selectModelFields = [
            'Motoristum' => '\App\Models\Motoristum',
            'ControleFrotum' => '\App\Models\ControleFrotum',
            'TipoMulta' => '\App\Models\TipoMulta',
            'Setor' => '\App\Models\Setor'
        ];
        $this->joinSearch = [
            'motorista_id' => ['nome', '\App\Models\Motoristum'],
            'controle_frota_id' => ['controle_frota', '\App\Models\ControleFrotum'],
            'tipo_multa_id' => ['tipo', '\App\Models\TipoMulta'],
            'setor_id' => ['setor', '\App\Models\Setor'],
        ];
        $this->fileName = ['foto_multa'];
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
            'data_vencimento' => 'required',
            'valor_multa' => 'required',
            'pago' => 'required',
            'foto_multa' => 'required',
            'status' => 'required',
        ];

        $this->indexFields = [['motorista', 'nome'], ['controle_frota', 'veiculo'], ['tipo_multa', 'tipo'], ['status']];
        $this->indexTitles = ['Motorista', 'Veículo', 'Tipo', 'Status'];

        $this->pdfFields = [['data_multa'], ['hora_multa'], ['motorista', 'nome'], ['controle_frota', 'placa'],
            ['setor', 'nome'],
            ['pago'], // MUNICIPIO
            ['tipo_multa', 'codigo'], ['pago'], ['valor_multa'], ['observacao']
        ];
        $this->pdfTitles = ['Data da Multa', 'Horário', 'Motorista', 'Veículo', 'Setor', 'Município', 'Tipo da Multa', 'Pago', 'Valor R$', 'Observação'];

        $this->numbersWithDecimal = ['valor_multa'];
    }

}
