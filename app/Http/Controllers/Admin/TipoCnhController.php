<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\TipoCnh;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class TipoCnhController extends Controller
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
    public function __construct(TipoCnh $tipocnh)
    {
        $this->middleware('auth');
        $this->model = $tipocnh;
        $this->saveSetorScope = false;
        $this->path = 'admin.tipo-cnh';
        $this->redirectPath = 'tipo-cnh';
        $this->withFields = [];
        $this->selectModelFields = [];
        $this->joinSearch = [];
        $this->pdfFields = [['nome'],['descricao'], ['status']];
        $this->pdfTitles = ['Título','Descrição', 'Status'];
        $this->indexFields = [['nome'],['descricao'], ['status']];
        $this->indexTitles = ['Título','Descrição', 'Status'];

        $this->pdfTitle = 'Categoria CNH';
    }

}
