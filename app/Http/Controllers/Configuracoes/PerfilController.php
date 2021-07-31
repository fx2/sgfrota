<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Perfil;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class PerfilController extends Controller
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
    public function __construct(Perfil $perfil)
    {
        $this->middleware('auth');
        $this->model = $perfil;
        $this->saveSetorScope = true;
        $this->path = 'configuracoes.perfil';
        $this->redirectPath = 'perfil';
        $this->pdfFields = [['nome'],['descricao'], ['status']];
        $this->pdfTitles = ['Nome','Descrição', 'Status'];
        $this->indexFields = [['nome'],['descricao'], ['status']];
        $this->indexTitles = ['Nome','Descrição', 'Status'];
        $this->selectModelFields = ['Setor' => '\App\Models\Setor'];
        $this->joinSearch = ['setor_id' => ['nome', '\App\Models\Setor']];
    }

}
