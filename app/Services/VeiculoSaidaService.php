<?php


namespace App\Services;

use App\Models\VeiculoSaida;

/**
 * Class VeiculoSaidaService
 * @package App\Services
 */
class VeiculoSaidaService
{
    /**
     * @var VeiculoSaida
     */
    protected VeiculoSaida $veiculoSaida;

    public function __construct(VeiculoSaida $veiculoSaida)
    {
        $this->veiculoSaida = $veiculoSaida;
    }

    public function veiculosDisponiveisSaida($id = false)
    {
        $result = $this->veiculoSaida::select('controle_frotas.id', 'controle_frotas.veiculo')
            ->join('controle_frotas', 'controle_frotas.id', '=', 'veiculo_saidas.controle_frota_id');

        if ($id) {
            $result = $result->where('veiculo_saidas.id', $id)->get();

            return $result;
        }

        $result = $result->whereNotIn('controle_frotas.id',function($query){
                $query->select('veiculo_saidas.controle_frota_id')->from('veiculo_saidas')->whereNull('veiculo_saidas.deleted_at');
            })
            ->withTrashed()
            ->get();

        return $result;
    }
}
