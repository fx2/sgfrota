<?php


namespace App\Services;


use App\Models\ControleFrotum;
use App\Models\VeiculoReservaEntrada;

class ControleFrotumKmService
{
    /**
     * @param int $id
     * @param double $km_atual
     */
    public function atualizaKilometragem($id, $km_atual, $entrada = false)
    {
        $car = ControleFrotum::where('id', $id)->first();

        $findKmAtual = decimal( $car->km_atual);
        $findKmAtual = str_replace(',', '', $findKmAtual);

        $kmAtual = str_replace('.', '', $km_atual);

        if ($entrada){
            if ($findKmAtual == null || $findKmAtual >= $kmAtual)
                return $findKmAtual;
        }

        if ($findKmAtual == null || $findKmAtual > $kmAtual){
            return $findKmAtual;
        }

        $km_atual = decimal(str_replace('.', '', str_replace(',', '', $km_atual)));
        $car->km_atual = str_replace('.', '', str_replace(',', '', $km_atual));
        $car->save();

        return true;
    }

    public function atualizaKilometragemVeiculoReserva($id, $km_atual, $entrada = false)
    {
        $car = VeiculoReservaEntrada::where('id', $id)->first();

        $findKmAtual = decimal( $car->km_atual);
        $findKmAtual = str_replace(',', '', $findKmAtual);

        $kmAtual = str_replace('.', '', $km_atual);

        if ($entrada){
            if ($findKmAtual == null || $findKmAtual >= $kmAtual)
                return $findKmAtual;
        }

        if ($findKmAtual == null || $findKmAtual > $kmAtual){
            return $findKmAtual;
        }

        $km_atual = decimal(str_replace('.', '', str_replace(',', '', $km_atual)));
        $car->km_atual = str_replace('.', '', str_replace(',', '', $km_atual));
        $car->save();

        return true;
    }
}
