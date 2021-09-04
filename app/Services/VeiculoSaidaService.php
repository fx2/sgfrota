<?php


namespace App\Services;

use App\Models\ControleFrotum;
use App\Models\VeiculoReservaEntrada;
use App\Models\VeiculoSaida;

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

    public function exibeDisponivel($id)
    {
        return $this->controleFrotum::select('id', 'veiculo', 'placa')->where('id', $id)->get();
    }

    public function exibeDisponivelVeiculoReserva($id)
    {
        $result = VeiculoReservaEntrada::select('id', 'veiculo', 'placa', 'id as veiculo_reserva_entrada_id')->where('id', $id)->get();

        return $result;
    }

    public function veiculosDisponiveisComReservas()
    {
        $result = $this->controleFrotum::select('id', 'veiculo', 'placa')->whereNotIn('id',function($query){
            $query->select('controle_frota_id')->from('veiculo_saidas')
                ->whereNull('veiculo_saidas.deleted_at')
                ->whereNotNull('veiculo_saidas.controle_frota_id')
                ->where('veiculo_saidas.status', '=', 1);
        })
        ->get();

        $ids = [];
        foreach ($result as $key => $val){
            $ids[$key] = $val->id;
        }

        $veiculos = VeiculoReservaEntrada::select('controle_frota_id as id', 'veiculo', 'placa', 'id as veiculo_reserva_entrada_id')
            ->whereIn('controle_frota_id', $ids)
            ->get();

        if ($veiculos->isEmpty())
            return $result;

        $filtered = $result->filter(function ($value, $key) use($veiculos){
            foreach ($veiculos as $val){
                return $value['id'] != $val->id;
            }
        });

        foreach ($veiculos as $vel){
            $verify = VeiculoSaida::where('veiculo_reserva_entrada_id', $vel->veiculo_reserva_entrada_id)->exists();
            if (!$verify)
                $filtered->push($vel);
        }

        return $filtered;
    }
}
