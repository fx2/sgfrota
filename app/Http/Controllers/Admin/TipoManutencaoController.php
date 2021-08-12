<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\TipoManutencao;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class TipoManutencaoController extends Controller
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
    public function __construct(TipoManutencao $tipomanutencao)
    {
        $this->middleware('auth');
        $this->model = $tipomanutencao;
        $this->saveSetorScope = false;
        $this->path = 'admin.tipo-manutencao';
        $this->redirectPath = 'tipo-manutencao';
        $this->pdfFields = [['nome'],['descricao'], ['status']];
        $this->pdfTitles = ['Título','Descrição', 'Status'];
        $this->indexFields = [['nome'],['descricao'], ['status']];
        $this->indexTitles = ['Título','Descrição', 'Status'];

        $this->pdfTitle = 'Tipos de Manutenções';
    }

}
