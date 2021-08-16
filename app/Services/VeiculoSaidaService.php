<?php


namespace App\Services;

use App\Models\ControleFrotum;

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

    public function veiculosDisponiveisSaida($id = false)
    {
        $result = $this->controleFrotum::select('id', 'veiculo');

        if ($id)
            return $result = $result->where('id', $id)->get();

        return $result = $result->whereNotIn('id',function($query){
            $query->select('controle_frota_id')->from('veiculo_saidas')->whereNull('veiculo_saidas.deleted_at')->where('veiculo_saidas.status', '=', 1);
        })
        ->get();
    }
}
