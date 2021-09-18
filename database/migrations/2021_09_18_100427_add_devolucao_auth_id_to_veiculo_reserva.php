<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDevolucaoAuthIdToVeiculoReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('veiculo_reserva_entradas', function (Blueprint $table) {
            $table->unsignedInteger('devolucao_auth_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('veiculo_reserva', function (Blueprint $table) {
            //
        });
    }
}
