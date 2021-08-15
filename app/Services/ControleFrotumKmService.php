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

        $findKmAtualInt = (int) $findKmAtual;
        $kmAtualInt = (int) $km_atual;

        if ($entrada){
            if ($findKmAtual == null || $findKmAtualInt >= $kmAtualInt)
                return $findKmAtual;
        }

        if ($findKmAtual == null || $findKmAtualInt > $kmAtualInt){
            return $findKmAtual;
        }

        $car->km_atual = str_replace('.', '', str_replace(',', '', $km_atual));
        $car->save();

        return true;
    }
}
