<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVeiculoReservaEntradaIdToVeiculoSaidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('veiculo_saidas', function (Blueprint $table) {
            $table->unsignedInteger('controle_frota_id')->nullable()->change();
            $table->unsignedInteger('veiculo_reserva_entrada_id')->after('controle_frota_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('veiculo_saidas', function (Blueprint $table) {
            //
        });
    }
}
