<?php


namespace App\Services;


use App\Models\VeiculoSaida;

/**
 * Class VeiculoSaidaService
 * @package App\Services
 */
class VeiculoEntradaService
{
    /**
     * @var VeiculoSaida
     */
    protected VeiculoSaida $veiculoSaida;

    public function __construct(VeiculoSaida $veiculoSaida)
    {
        $this->veiculoSaida = $veiculoSaida;
    }

    public function veiculosDisponiveisEntrada($id = false)
    {
        $result = $this->veiculoSaida::select('controle_frotas.id', 'controle_frotas.veiculo', 'veiculo_saidas.id as veiculo_saida_id')
            ->join('controle_frotas', 'controle_frotas.id', '=', 'veiculo_saidas.controle_frota_id')
            ->whereIn('controle_frotas.id',function($query){
                $query->select('veiculo_saidas.controle_frota_id')->from('veiculo_saidas')->whereNull('veiculo_saidas.deleted_at')->where('veiculo_saidas.status', '=', 1);
            });

        if ($id) {
            $result = $result->where('veiculo_saidas.id', $id)->get();

            return $result;
        }

        $result = $result->get();

        return $result;
    }
}
