<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterKmAtualToVeiculoReservaEntradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('veiculo_reserva_entradas', function (Blueprint $table) {
            $table->decimal('km_inicial', 16, 4)->nullable()->change();
            $table->decimal('km_atual', 16, 4)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('veiculo_reserva_entradas', function (Blueprint $table) {
            //
        });
    }
}
