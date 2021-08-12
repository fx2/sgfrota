<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Setor;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class SetorController extends Controller
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
    public function __construct(Setor $setor)
    {
        $this->middleware('auth');
        $this->model = $setor;
        $this->saveSetorScope = false;
        $this->path = 'admin.setor';
        $this->redirectPath = 'setor';
        $this->withFields = [];
        $this->selectModelFields = [];
        $this->joinSearch = [];
        $this->fileName = [];
        $this->uploadFilePath = 'images/setor';
        $this->validations = [];
        $this->pdfFields = [['nome'], ['descricao'], ['status']];
        $this->pdfTitles = ['Nome', 'Descrição', 'Status'];
        $this->indexFields = [['nome'], ['descricao'], ['status']];
        $this->indexTitles = ['Nome', 'Descrição', 'Status'];

        $this->pdfTitle = 'Setores';
    }

}
