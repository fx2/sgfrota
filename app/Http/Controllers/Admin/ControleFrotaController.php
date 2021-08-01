<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\ControleFrotum;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class ControleFrotaController extends Controller
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
    public function __construct(ControleFrotum $controlefrota)
    {
        $this->middleware('auth');
        $this->model = $controlefrota;
        $this->saveSetorScope = true;
        $this->path = 'admin.controle-frota';
        $this->redirectPath = 'controle-frota';
        $this->withFields = ['tipo_veiculoHasOne', 'tipo_combustivel', 'marca', 'modelo', 'responsavel', 'setor'];
        $this->selectModelFields = [
            'TipoVeiculo' => '\App\Models\TipoVeiculo',
            'TipoCombustivel' => '\App\Models\TipoCombustivel',
            'Marca' => '\App\Models\Marca',
            'Modelo' => '\App\Models\Modelo',
            'TipoResponsavel' => '\App\Models\TipoResponsavel',
            'Setor' => '\App\Models\Setor',
        ];
        $this->joinSearch = [
            'tipo_veiculo_id' => ['nome', '\App\Models\TipoVeiculo'],
            'tipo_combustivel_id' => ['nome', '\App\Models\TipoCombustivel'],
            'marca_id' => ['nome', '\App\Models\Marca'],
            'modelo_id' => ['modelo', '\App\Models\Modelo'],
            'tipo_responsavel_id' => ['responsavel', '\App\Models\TipoResponsavel'],
            'setor' => ['setor', '\App\Models\Setor'],
        ];
        $this->fileName = ['dut', 'certificado_vistoria', 'foto'];
        $this->uploadFilePath = 'images/controle-frota';
        $this->validations = [
            'tipo_veiculo_id' => 'required',
            'tipo_combustivel_id' => 'required',
            'marca_id' => 'required',
            'modelo_id' => 'required',
            'tipo_responsavel' => 'required',
            'tipo_responsavel_id' => 'required',
            'tipo_veiculo' => 'required',
            'disponivel_outros_departamentos' => 'required',
            // 'veiculo_escolar' => 'required',
            'renavan' => 'required',
            'placa' => 'required',
            'chassi' => 'required',
            'especie_tipo' => 'required',
            'veiculo' => 'required',
            'ano_fabricacao' => 'required',
            'ano_modelo' => 'required',
            'capacidade' => 'required',
            'cor' => 'required',
            'patrimonio' => 'required',
            'estado_veiculo' => 'required',
            'km_inicial' => 'required',
            'dut' => 'required',
            'foto' => 'required',
            'status' => 'required',
        ];
        $this->indexFields = [['veiculo'], ['placa'], ['marca', 'nome'], ['modelo', 'modelo'], ['responsavel', 'nome'], ['status']];
        $this->indexTitles = ['Veículo', 'Placa', 'Marca', 'Modelo', 'Responsável', 'Status'];
        $this->pdfFields = [['veiculo'], ['placa'], ['marca', 'nome'], ['modelo', 'modelo'], ['responsavel', 'nome'], ['status']];
        $this->pdfTitles = ['Veículo', 'Placa', 'Marca', 'Modelo', 'Responsável', 'Status'];

        $this->numbersWithDecimal = ['km_inicial'];

    }

}
