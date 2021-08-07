<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\ValeCombustiveisLavagen;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class ValeCombustiveisLavagensController extends Controller
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
    public function __construct(ValeCombustiveisLavagen $valecombustiveislavagens)
    {
        $this->middleware('auth');
        $this->middleware('checksetor:51', ['only' => ['index']]);
        $this->middleware('checksetor:52', ['only' => ['create']]);
        $this->middleware('checksetor:53', ['only' => ['edit']]);
        $this->middleware('checksetor:54', ['only' => ['destroy']]);
        $this->middleware('checksetor:55', ['only' => ['relatorio']]);

        $this->model = $valecombustiveislavagens;
        $this->saveSetorScope = true;
        $this->path = 'admin.vale-combustiveis-lavagens';
        $this->redirectPath = 'vale-combustiveis-lavagens';
        $this->withFields = ['controle_frota', 'tipo_combustivel', 'setor'];
        $this->selectModelFields = [
            'ControleFrotum' => '\App\Models\ControleFrotum',
            'TipoCombustivel' => '\App\Models\TipoCombustivel',
            'Setor' => '\App\Models\Setor'
        ];
        $this->joinSearch = [
            'tipo_combustivel_id' => ['tipo_combustivel', '\App\Models\TipoCombustivel'],
            'controle_frota_id' => ['controle_frota', '\App\Models\ControleFrotum'],
            'setor_id' => ['setor', '\App\Models\Setor'],
        ];
        $this->fileName = [];
        $this->uploadFilePath = 'images/vale-combustiveis-lavagens';
        $this->validations = [];
        $this->pdfFields = [['data'], ['hour'], ['nome_responsavel'], ['controle_frota', 'placa'], ['setor', 'nome'], ['tipo_vale'], ['quantidade_litros'], ['tipo_combustivel', 'nome'], ['observacao']];
        $this->pdfTitles = ['Data', 'Horário', 'Responsável', 'Veículo', 'Setor', 'Produto', 'Qtd Litros', 'Tipo de Combustível', 'Observação'];
        $this->indexFields = [['id'], ['tipo_vale']];
        $this->indexTitles = ['Id', 'Tipo de Vale'];
    }

}
