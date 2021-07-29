<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Motoristum;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class MotoristaController extends Controller
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
    public function __construct(Motoristum $motorista)
    {
        $this->middleware('auth');
        $this->model = $motorista;
        $this->saveSetorScope = true;
        $this->path = 'admin.motorista';
        $this->redirectPath = 'motorista';
        $this->withFields = ['tipoCnh'];
        $this->selectModelFields = ['TipoCnh' => '\App\Models\TipoCnh'];
        $this->joinSearch = ['tipo_cnh_id' => ['tipoCnh' => '\App\Models\TipoCnh']];
        $this->fileName = ['imagem', 'cnh_imagem', 'img_upload'];
        $this->uploadFilePath = 'images/motoristas';
//        $this->checkboxExplode = ['tipo_motorista'];

        $this->indexFields = [['nome'], ['tipoCnh', 'nome'],['status']];
        $this->indexTitles = ['Nome', 'CNH', 'Status'];

        $this->pdfFields = [['nome'], ['tipoCnh', 'nome'],['status']];
        $this->pdfTitles = ['Nome', 'CNH', 'Status'];
        $this->validations = [
            // 'motorista_escolar' => 'required',
            'nome' => 'required',
            'rg' => 'required',
            'cpf' => 'required',
            'data_nascimento' => 'required',
            'email' => 'required',
            'telefone' => 'required',
            'celular' => 'required',
            // 'imagem' => 'required',
            'cnh' => 'required',
            'tipo_cnh_id' => 'required',
            'cnh_primeira' => 'required',
            'cnh_validade' => 'required',
            'cnh_emissao' => 'required',
            'cnh_imagem' => 'required',
            'status' => 'required|boolean',
        ];
    }
}
