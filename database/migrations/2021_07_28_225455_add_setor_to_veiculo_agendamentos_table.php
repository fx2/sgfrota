<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSetorToVeiculoAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('veiculo_agendamentos', function (Blueprint $table) {
            $table->unsignedInteger('setor_id')->after('id');
            $table->foreign('setor_id')->references('id')->on('setors')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('veiculo_agendamentos', function (Blueprint $table) {
            //
        });
    }
}
