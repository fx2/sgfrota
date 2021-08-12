<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Marca;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class MarcaController extends Controller
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
    public function __construct(Marca $marca)
    {
        $this->middleware('auth');
        $this->model = $marca;
        $this->saveSetorScope = false;
        $this->path = 'admin.marca';
        $this->redirectPath = 'marca';
        $this->pdfFields = [['nome'],['descricao'], ['status']];
        $this->pdfTitles = ['Título','Descrição', 'Status'];
        $this->indexFields = [['nome'],['descricao'], ['status']];
        $this->indexTitles = ['Título','Descrição', 'Status'];
        $this->pdfTitle = 'Marcas';
    }

}
