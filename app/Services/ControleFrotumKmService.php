<?php


namespace App\Services;


use App\Models\ControleFrotum;

class ControleFrotumKmService
{
    /**
     * @param int $id
     * @param double $km_atual
     */
    public function atualizaKilometragem($id, $km_atual, $entrada = false)
    {
        $car = ControleFrotum::where('id', $id)->first();

        $findKmAtual = decimal($car->km_atual);
        $km_atual = decimal(str_replace('.', '', str_replace(',', '', $km_atual)));

        if ($entrada){
            if ($findKmAtual == null || $findKmAtual >= $km_atual){
            return $findKmAtual;
        }

        }
        if ($findKmAtual == null || $findKmAtual > $km_atual){
            return $findKmAtual;
        }

        $car->km_atual = str_replace('.', '', str_replace(',', '', $km_atual));
        $car->save();

        return true;
    }
}
