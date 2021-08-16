<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\PermissoesUsuario;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class PermissoesUsuarioController extends Controller
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
    public function __construct(PermissoesUsuario $permissoesusuario)
    {
        $this->middleware('auth');
        $this->model = $permissoesusuario;
        $this->path = 'configuracoes.permissoes-usuario';
        $this->redirectPath = 'permissoes-usuario';
        $this->withFields = [];
        $this->selectModelFields = [];
        $this->joinSearch = [];
        $this->fileName = [];
        $this->uploadFilePath = 'images/permissoes-usuario';
        $this->validations = [];
        $this->pdfFields = [['id']];
        $this->pdfTitles = ['Id'];
        $this->indexFields = [['id']];
        $this->indexTitles = ['Id'];

                $this->pdfTitle = 'Permissões Usuários';

    }

}
