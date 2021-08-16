<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\TipoMulta;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class TipoMultasController extends Controller
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
    public function __construct(TipoMulta $tipomultas)
    {
        $this->middleware('auth');
        $this->model = $tipomultas;
        $this->saveSetorScope = false;
        $this->path = 'admin.tipo-multas';
        $this->redirectPath = 'tipo-multas';
        $this->pdfFields = [['tipo'],['descricao'], ['pontuacao'],  ['status']];
        $this->pdfTitles = ['Tipo','Descrição', 'Pontuação', 'Status'];
        $this->indexFields = [['tipo'],['descricao'], ['pontuacao'], ['status']];
        $this->indexTitles = ['Tipo','Descrição', 'Pontuação', 'Status'];

        $this->pdfTitle = 'Tipos de Multas';
    }

}
