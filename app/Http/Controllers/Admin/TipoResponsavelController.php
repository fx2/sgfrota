<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\TipoResponsavel;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class TipoResponsavelController extends Controller
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
    public function __construct(TipoResponsavel $tiporesponsavel)
    {
        $this->middleware('auth');
        $this->model = $tiporesponsavel;
        $this->saveSetorScope = false;
        $this->path = 'admin.tipo-responsavel';
        $this->redirectPath = 'tipo-responsavel';
        $this->withFields = [];
        $this->selectModelFields = [];
        $this->joinSearch = [];
        $this->fileName = [];
        $this->uploadFilePath = 'images/tipo-responsavel';
        $this->validations = [];
        $this->pdfFields = [['nome'], ['descricao']];
        $this->pdfTitles = ['Nome', 'Descricao'];
        $this->indexFields = [['nome'], ['descricao']];
        $this->indexTitles = ['Nome', 'Descricao'];

        $this->pdfTitle = 'Tipo de Responsáveis';
    }

}
