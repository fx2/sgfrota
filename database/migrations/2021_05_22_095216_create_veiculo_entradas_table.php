<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVeiculoEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculo_entradas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('controle_frota_id');
            $table->double('km_final')->nullable();
            $table->text('relatorio_trajeto_motorista')->nullable();
            $table->double('quantidade_combustivel')->nullable();
            $table->text('observacao')->nullable();
            $table->string('nome_responsavel')->nullable();
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
        Schema::drop('veiculo_entradas');
    }
}
