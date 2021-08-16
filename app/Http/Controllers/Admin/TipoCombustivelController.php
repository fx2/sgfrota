<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\TipoCombustivel;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class TipoCombustivelController extends Controller
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
    public function __construct(TipoCombustivel $tipocombustivel)
    {
        $this->middleware('auth');
        $this->model = $tipocombustivel;
        $this->saveSetorScope = false;
        $this->path = 'admin.tipo-combustivel';
        $this->redirectPath = 'tipo-combustivel';
        $this->pdfFields = [['nome'],['descricao'], ['status']];
        $this->pdfTitles = ['Título','Descrição', 'Status'];
        $this->indexFields = [['nome'],['descricao'], ['status']];
        $this->indexTitles = ['Título','Descrição', 'Status'];

        $this->pdfTitle = 'Tipos de Combustíveis';
    }

}
