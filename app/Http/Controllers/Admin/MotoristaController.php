<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Motoristum;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class MotoristaController extends Controller
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
    public function __construct(Motoristum $motorista)
    {
        $this->middleware('auth');
        // $this->middleware('checksetor:' . MOTORISTAS_VISUALIZAR, ['only' => ['index']]);
        // $this->middleware('checksetor:' . MOTORISTAS_ADICIONAR, ['only' => ['create']]);
        // $this->middleware('checksetor:' . MOTORISTAS_EDITAR, ['only' => ['edit']]);
        // $this->middleware('checksetor:' . MOTORISTAS_DELETAR, ['only' => ['destroy']]);
        // $this->middleware('checksetor:' . MOTORISTAS_RELATORIO, ['only' => ['relatorio']]);

        $this->model = $motorista;
        $this->saveSetorScope = true;
        $this->path = 'admin.motorista';
        $this->redirectPath = 'motorista';
        $this->withFields = ['tipoCnh'];
        $this->selectModelFields = [
            'TipoCnh' => '\App\Models\TipoCnh',
            'Setor' => '\App\Models\Setor'
        ];
        $this->joinSearch = [
            'tipo_cnh_id' => ['tipoCnh' => '\App\Models\TipoCnh'],
            'setor_id' => ['setor' => '\App\Models\Setor']
        ];
        $this->fileName = ['imagem', 'cnh_imagem', 'img_upload'];
        $this->uploadFilePath = 'images/motoristas';
//        $this->checkboxExplode = ['tipo_motorista'];

        $this->indexFields = [['nome'], ['tipoCnh', 'nome'],['status']];
        $this->indexTitles = ['Motorista', 'CNH', 'Status'];

        $this->pdfFields = [['setor', 'nome'], ['nome'], ['data_nascimento'], ['cnh'], ['tipoCnh', 'nome'],  ['cnh_validade']];
        $this->pdfTitles = ['Setor', 'Motorista', 'Data Nasc', 'CNH', 'Categoria', 'Venc. da Habilitação'];

        $this->validations = [
            // 'motorista_escolar' => 'required',
            'nome' => 'required',
            'rg' => 'required',
            'cpf' => 'required',
            'data_nascimento' => 'required',
            'email' => 'required',
//            'telefone' => 'required',
//            'celular' => 'required',
            // 'imagem' => 'required',
            'cnh' => 'required',
            'tipo_cnh_id' => 'required',
            'cnh_primeira' => 'required',
            'cnh_validade' => 'required',
            'cnh_emissao' => 'required',
            'cnh_imagem' => 'required',
            'status' => 'required|boolean',
        ];

        $this->pdfTitle = 'Motoristas';
    }

    public function customListagem(Request $request)
    {
        $limit = $request->all()['limit'] ?? 20;

        $result = $this->model;
        $requestData = $request->all();

        if($requestData['nome'] !== null)
            $result = $result->where('nome', 'LIKE', "%$requestData[nome]%");

        if($requestData['cpf'] !== null)
            $result = $result->where('cpf', 'LIKE', "%$requestData[cpf]%");

        if($requestData['data_inicial'] !== null)
            $result = $result->whereDate('cnh_validade', '>=', convertTimestampToBd($requestData['data_inicial'], 'Y-m-d'));

        if($requestData['data_final'] !== null)
            $result = $result->whereDate('cnh_validade', '<=', convertTimestampToBd($requestData['data_final'], 'Y-m-d'));

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
