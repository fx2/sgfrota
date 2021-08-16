<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Permisso;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class PermissoesController extends Controller
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
    public function __construct(Permisso $permissoes)
    {
        $this->middleware('auth');
        $this->model = $permissoes;
        $this->path = 'configuracoes.permissoes';
        $this->redirectPath = 'permissoes';
        $this->withFields = [];
        $this->selectModelFields = [];
        $this->joinSearch = [];
        $this->fileName = [];
        $this->uploadFilePath = 'images/permissoes';
        $this->validations = [];
        $this->pdfFields = [['id']];
        $this->pdfTitles = ['Id'];
        $this->indexFields = [['id']];
        $this->indexTitles = ['Id'];

                $this->pdfTitle = 'Permissões';

    }

}
