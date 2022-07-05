<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Abastecimento;
use App\Traits\CrudControllerTrait;
use Illuminate\Http\Request;

class AbastecimentoController extends Controller
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
    public function __construct(Abastecimento $abastecimento)
    {
        $this->middleware('auth');
        // $this->middleware('checksetor:' . ABASTECIMENTOS_VISUALIZAR, ['only' => ['index']]);
        // $this->middleware('checksetor:' . ABASTECIMENTOS_ADICIONAR, ['only' => ['create']]);
        // $this->middleware('checksetor:' . ABASTECIMENTOS_EDITAR, ['only' => ['edit']]);
        // $this->middleware('checksetor:' . ABASTECIMENTOS_DELETAR, ['only' => ['destroy']]);
        // $this->middleware('checksetor:' . ABASTECIMENTOS_RELATORIO, ['only' => ['relatorio']]);

        $this->model = $abastecimento;
        $this->saveSetorScope = true;
        $this->path = 'admin.abastecimento';
        $this->redirectPath = 'abastecimento';
        $this->withFields = ['controle_frota', 'tipo_combustivel', 'fornecedor', 'setor'];
        $this->selectModelFields = [
            'ControleFrotum' => '\App\Models\ControleFrotum',
            'TipoCombustivel' => '\App\Models\TipoCombustivel',
            'Fornecedor' => '\App\Models\Fornecedor',
            'Setor' => '\App\Models\Setor',
        ];
        $this->joinSearch = [
            'controle_frota_id' => ['controle_frota', '\App\Models\ControleFrotum'],
            'tipo_combustivel_id' => ['nome', '\App\Models\TipoCombustivel'],
            'fornecedor_id' => ['razao_social', '\App\Models\Fornecedor'],
            'setor_id' => ['nome', '\App\Models\Setor']
        ];
        $this->fileName = ['foto'];
        $this->uploadFilePath = 'images/abastecimento';
        $this->validations = [
//            'qtd_litros' => 'required',
//            'valor' => 'required',
            'controle_frota_id' => 'required|integer',
//            'tipo_combustivel_id' => 'required|integer',
//            'fornecedor_id' => 'required|integer',
//            'foto' => 'required',
//            'km_atual' => 'required',
//            'responsavel' => 'required|string',
        
            'status' => 'required|boolean',
        ];

        $this->pdfFields = [
            ['data'], ['hora'], ['km_atual'], ['responsavel'], ['controle_frota', 'placa'], ['setor', 'nome'], ['tipo_combustivel', 'nome'],
            ['fornecedor', 'razao_social'], ['qtd_litros'], ['valor']
        ];
        $this->pdfTitles = ['Data','Horário', 'KM', 'Responsável', 'Veículo', 'Setor', 'Combustível', 'Fornecedor', 'Qtd Litros', 'Valor R$'];

        $this->indexFields = [['responsavel'], ['tipo_combustivel', 'nome'],['fornecedor', 'razao_social'], ['status']];
        $this->indexTitles = ['Responsável','Tipo de Combustível', 'Fornecedor', 'Status'];

                $this->pdfTitle = 'Abastecimento';

        $this->numbersWithDecimal = ['km_atual', 'qtd_litros', 'valor'];
    }

    public function create()
    {
        $id = $this->model::orderBy('id', 'desc')->first()['id'] ?? 0;
        $sequencial = $id + 1 . '/' .date('Y');

        return view($this->path.'.create', ['selectModelFields' => $this->selectModelFields(), 'sequencial' => $sequencial]);
    }

    public function customListagem(Request $request)
    {
        $limit = $request->all()['limit'] ?? 20;

        $result = $this->model;
        $requestData = $request->all();

        if($requestData['fornecedor_id'] !== null)
            $result = $result->where('fornecedor_id', '=', $requestData['fornecedor_id']);

        if($requestData['controle_frota_id'] !== null)
            $result = $result->where('controle_frota_id', '=', $requestData['controle_frota_id']);

        if($requestData['responsavel'] !== null)
            $result = $result->where('responsavel', 'LIKE', "%$requestData[responsavel]%");

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
