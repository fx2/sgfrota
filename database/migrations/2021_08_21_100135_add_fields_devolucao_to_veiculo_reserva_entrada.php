<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsDevolucaoToVeiculoReservaEntrada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('veiculo_reserva_entradas', function (Blueprint $table) {
            $table->date('devolucao_data')->nullable();
            $table->time('devolucao_horario')->nullable();
            $table->double('devolucao_km_atual')->nullable();
            $table->string('devolucao_combustivel')->nullable();
            $table->string('devolucao_recebido_por')->nullable();
            $table->text('devolucao_observacao')->nullable();
            $table->string('tipo')->default('entrada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('veiculo_reserva_entrada', function (Blueprint $table) {
            //
        });
    }
}
