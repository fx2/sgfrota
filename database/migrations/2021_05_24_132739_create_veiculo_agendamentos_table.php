<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVeiculoAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculo_agendamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('controle_frota_id');
            $table->string('departamento')->nullable();
            $table->string('periodo');
            $table->string('telefone')->nullable();
            $table->string('local')->nullable();
            $table->dateTime('previsao_saida')->nullable();
            $table->dateTime('previsao_volta')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('controle_frota_id')->references('id')->on('controle_frotas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('veiculo_agendamentos');
    }
}
