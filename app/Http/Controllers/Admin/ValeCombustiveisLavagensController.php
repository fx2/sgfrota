<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\ValeCombustiveisLavagen;
use App\Services\VerificaPerfil;
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
            'tipo_combustivel_id' => ['nome', '\App\Models\TipoCombustivel'],
            'controle_frota_id' => ['placa', '\App\Models\ControleFrotum'],
            'setor_id' => ['nome', '\App\Models\Setor'],
        ];
        $this->fileName = [];
        $this->uploadFilePath = 'images/vale-combustiveis-lavagens';
        $this->validations = [];
        $this->pdfFields = [['data'], ['hour'], ['nome_responsavel'], ['controle_frota', 'placa'], ['setor', 'nome'], ['tipo_vale'], ['quantidade_litros'], ['tipo_combustivel', 'nome'], ['observacao']];
        $this->pdfTitles = ['Data', 'Horário', 'Responsável', 'Veículo', 'Setor', 'Produto', 'Qtd Litros', 'Tipo de Combustível', 'Observação'];
        $this->indexFields = [['nome_responsavel'], ['controle_frota', 'placa'], ['tipo_vale']];
        $this->indexTitles = ['Responsável', 'Veículo', 'Tipo de Vale'];
    }

    public function customListagem(Request $request)
    {
        $limit = $request->all()['limit'] ?? 20;

        $result = $this->model;
        $requestData = $request->all();

//        if($requestData['nome_responsavel'] !== null)
//            $result = $result->orWhere('nome_responsavel', 'LIKE', "%$requestData[nome_responsavel]%");
//
        if($requestData['tipo_vale'] !== null)
            $result = $result->orWhere('tipo_vale', '=', "$requestData[tipo_vale]");

        if($requestData['controle_frota_id'] !== null)
            $result = $result->orWhere('controle_frota_id', '=', $requestData['controle_frota_id']);

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

        return view($this->path.'.index', ['results'=>$result, 'selectModelFields' => $this->selectModelFields(), 'fields' => $this->indexFields, 'titles' => $this->indexTitles]);
    }

}
