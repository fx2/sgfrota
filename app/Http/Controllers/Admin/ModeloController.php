<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Modelo;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class ModeloController extends Controller
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
    public function __construct(Modelo $modelo)
    {
        $this->middleware('auth');
        $this->model = $modelo;
        $this->saveSetorScope = false;
        $this->path = 'admin.modelo';
        $this->redirectPath = 'modelo';
        $this->withFields = ['marca', 'tipo_veiculo'];
        $this->selectModelFields = ['Marca' => '\App\Models\Marca', 'TipoVeiculo' => '\App\Models\TipoVeiculo'];
        $this->joinSearch = ['marca_id' => ['nome', '\App\Models\Marca'], 'tipo_veiculo_id' => ['nome', '\App\Models\TipoVeiculo']];
        $this->indexFields = [['modelo'], ['descricao'],['status']];
        $this->indexTitles = ['Modelo', 'Descrição','Status'];

        $this->pdfFields = ['modelo', 'descricao','status'];
        $this->pdfTitles = [['Modelo'], ['Descrição'],['Status']];

        $this->fileName = ['foto'];
        $this->uploadFilePath = 'images/modelos';
        $this->validations = [
            'tipo_veiculo_id' => 'required',
            'marca_id' => 'required',
            'modelo' => 'required',
        ];

        $this->pdfTitle = 'Modelos';
    }
}
