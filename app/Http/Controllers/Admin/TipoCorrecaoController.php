<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\TipoCorrecao;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class TipoCorrecaoController extends Controller
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
    public function __construct(TipoCorrecao $tipocorrecao)
    {
        $this->middleware('auth');
        $this->model = $tipocorrecao;
        $this->saveSetorScope = false;
        $this->path = 'admin.tipo-correcao';
        $this->redirectPath = 'tipo-correcao';
        $this->withFields = [];
        $this->selectModelFields = [];
        $this->joinSearch = [];
        $this->fileName = [];
        $this->uploadFilePath = 'images/';
        $this->validations = [];
        $this->pdfFields = [['nome'], ['descricao'], ['status']];
        $this->pdfTitles = ['Id', 'Descrição', 'Status'];
        $this->indexFields = [['nome'], ['descricao'], ['status']];
        $this->indexTitles = ['Id', 'Descrição', 'Status'];

        $this->pdfTitle = 'Tipo de Correções';
    }

}
