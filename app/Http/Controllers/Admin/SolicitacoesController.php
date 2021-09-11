<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Solicitaco;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class SolicitacoesController extends Controller
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
    public function __construct(Solicitaco $solicitacoes)
    {
        $this->middleware('auth');
        $this->middleware('checksetor:' . SOLICITACOES_VISUALIZAR, ['only' => ['index']]);
        $this->middleware('checksetor:' . SOLICITACOES_ADICIONAR, ['only' => ['create']]);
        $this->middleware('checksetor:' . SOLICITACOES_EDITAR, ['only' => ['edit']]);
        $this->middleware('checksetor:' . SOLICITACOES_DELETAR, ['only' => ['destroy']]);
        $this->middleware('checksetor:' . SOLICITACOES_RELATORIO, ['only' => ['relatorio']]);

        $this->model = $solicitacoes;
        $this->path = 'admin.solicitacoes';
        $this->redirectPath = 'solicitacoes';
        $this->withFields = [];
        $this->selectModelFields = [];
        $this->joinSearch = [];
        $this->fileName = [];
        $this->uploadFilePath = 'images/solicitacoes';
        $this->validations = [];
        $this->pdfFields = [['id']];
        $this->pdfTitles = ['Id'];
        $this->indexFields = [['id']];
        $this->indexTitles = ['Id'];
    }

}
