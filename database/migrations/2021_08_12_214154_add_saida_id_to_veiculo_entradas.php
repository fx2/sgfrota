<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSaidaIdToVeiculoEntradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('veiculo_entradas', function (Blueprint $table) {
            $table->unsignedInteger('veiculo_saida_id')->nullable()->after('controle_frota_id');
            $table->foreign('setor_id')->references('id')->on('veiculo_saidas')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::enableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('veiculo_entradas', function (Blueprint $table) {
            //
        });
    }
}
