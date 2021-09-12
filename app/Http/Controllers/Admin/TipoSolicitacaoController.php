<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\TipoSolicitacao;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class TipoSolicitacaoController extends Controller
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
    public function __construct(TipoSolicitacao $tiposolicitacao)
    {
        $this->middleware('auth');
        // $this->middleware('checksetor:' . TIPOSOLICITACOES_VISUALIZAR, ['only' => ['index']]);
        // $this->middleware('checksetor:' . TIPOSOLICITACOES_ADICIONAR, ['only' => ['create']]);
        // $this->middleware('checksetor:' . TIPOSOLICITACOES_EDITAR, ['only' => ['edit']]);
        // $this->middleware('checksetor:' . TIPOSOLICITACOES_DELETAR, ['only' => ['destroy']]);
        // $this->middleware('checksetor:' . TIPOSOLICITACOES_RELATORIO, ['only' => ['relatorio']]);

        $this->model = $tiposolicitacao;
        $this->path = 'admin.tipo-solicitacao';
        $this->redirectPath = 'tipo-solicitacao';
        $this->withFields = [];
        $this->selectModelFields = [];
        $this->joinSearch = [];
        $this->fileName = [];
        $this->uploadFilePath = 'images/tipo-solicitacao';
        $this->validations = [];
        $this->pdfFields = [['nome'], ['descricao']];
        $this->pdfTitles = ['Nome', 'Descrição'];
        $this->indexFields = [['nome'], ['descricao']];
        $this->indexTitles = ['Nome', 'Descrição'];
        $this->saveSetorScope = false;
    }

}
