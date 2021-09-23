<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class FornecedorController extends Controller
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
    public function __construct(Fornecedor $fornecedor)
    {
        $this->middleware('auth');
        // $this->middleware('checksetor:1', ['only' => ['index']]);
        // $this->middleware('checksetor:2', ['only' => ['create']]);
        // $this->middleware('checksetor:3', ['only' => ['edit']]);
        // $this->middleware('checksetor:4', ['only' => ['destroy']]);
        // $this->middleware('checksetor:5', ['only' => ['relatorio']]);

        $this->model = $fornecedor;
        $this->saveSetorScope = false;
        $this->path = 'admin.fornecedor';
        $this->redirectPath = 'fornecedor';
        $this->pdfFields = [['razao_social'], ['nome_fantasia'], ['cnpj'], ['status']];
        $this->pdfTitles = ['Razão Social','Nome Fantasia', 'CNPJ', 'Status'];
        $this->indexFields = [['razao_social'], ['nome_fantasia'], ['cnpj'], ['status']];;
        $this->indexTitles = ['Razão Social','Nome Fantasia', 'CNPJ', 'Status'];
        $this->pdfTitle = 'Fornecedor';
    }

}
