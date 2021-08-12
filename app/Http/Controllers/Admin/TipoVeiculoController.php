<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\TipoVeiculo;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class TipoVeiculoController extends Controller
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
    public function __construct(TipoVeiculo $tipoveiculo)
    {
        $this->middleware('auth');
        $this->model = $tipoveiculo;
        $this->saveSetorScope = false;
        $this->path = 'admin.tipo-veiculo';
        $this->redirectPath = 'tipo-veiculo';
        $this->pdfFields = [['nome'],['descricao'], ['status']];
        $this->pdfTitles = ['Título','Descrição', 'Status'];
        $this->indexFields = [['nome'],['descricao'], ['status']];
        $this->indexTitles = ['Título','Descrição', 'Status'];

        $this->pdfTitle = 'Tipos de Veículos';
    }

}
