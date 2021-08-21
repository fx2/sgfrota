<?php


namespace App\Services;

use App\Models\ControleFrotum;
use App\Models\VeiculoReservaEntrada;

/**
 * Class VeiculoSaidaService
 * @package App\Services
 */
class VeiculoSaidaService
{
    /**
     * @var ControleFrotum
     */
    protected ControleFrotum $controleFrotum;

    public function __construct(ControleFrotum $controleFrotum)
    {
        $this->controleFrotum = $controleFrotum;
    }

    public function veiculosDisponiveisSaida($result = false)
    {
        if ($result){
            if ($result->controle_frota_id){
                return $this->exibeDisponivel($result->controle_frota_id);
            }

            return $this->exibeDisponivelVeiculoReserva($result->veiculo_reserva_entrada_id);
        }

        return $this->veiculosDisponiveisComReservas();
    }

    public function exibeDisponivel($result, $id)
    {
        return $this->controleFrotum::select('id', 'veiculo')->where('id', $id)->get();
    }

    public function exibeDisponivelVeiculoReserva($id)
    {
        $result = VeiculoReservaEntrada('id', 'veiculo')->where('id', $id)->get();

        return $result;
    }

    public function veiculosDisponiveisComReservas()
    {
        $result = $this->controleFrotum::select('id', 'veiculo')->whereNotIn('id',function($query){
            $query->select('controle_frota_id')->from('veiculo_saidas')
                ->whereNull('veiculo_saidas.deleted_at')
                ->whereNotNull('veiculo_saidas.controle_frota_id')
                ->where('veiculo_saidas.status', '=', 1);
        })
        ->get();

        $veiculos = VeiculoReservaEntrada::select('controle_frota_id as id', 'veiculo', 'id as veiculo_reserva_entrada_id')->whereIn('controle_frota_id', $result->keys())->get();

        if ($veiculos->isEmpty())
            return $result;

        $filtered = $result->filter(function ($value, $key) use($veiculos){
            foreach ($veiculos as $val){
                return $value['id'] != $val->id;
            }
        });

        foreach ($veiculos as $vel){
            $filtered->push($vel);
        }

        return $filtered;
    }
}
