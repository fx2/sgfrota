<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVeiculoSaidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculo_saidas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('controle_frota_id');
            $table->unsignedInteger('motorista_id');
            $table->string('nome_responsavel')->nullable();
            $table->double('km_inicial')->nullable();
            $table->double('quantidade_combustivel')->nullable();
            $table->boolean('mecanica')->nullable();
            $table->boolean('eletrica')->nullable();
            $table->boolean('funilaria')->nullable();
            $table->boolean('pintura')->nullable();
            $table->boolean('pneus')->nullable();
            $table->text('observacao_situacao')->nullable();
            $table->boolean('macaco')->nullable();
            $table->boolean('triangulo')->nullable();
            $table->boolean('estepe')->nullable();
            $table->boolean('extintor')->nullable();
            $table->boolean('chave_roda')->nullable();
            $table->text('observacao_acessorio')->nullable();
            $table->boolean('status')->nullable();
            $table->foreign('controle_frota_id')->references('id')->on('controle_frotas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('motorista_id')->references('id')->on('motoristas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('veiculo_saidas');
    }
}
