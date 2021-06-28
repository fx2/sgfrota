<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateManutencaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manutencaos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tipo_manutencao_id');
            $table->unsignedInteger('fornecedor_id');
            $table->unsignedInteger('tipo_correcao_id');
            $table->string('responsavel_retirada')->nullable();
            $table->text('descricao_manutencao')->nullable();
            $table->string('numero_processo')->nullable();
            $table->date('data')->nullable();
            $table->time('hora')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tipo_manutencao_id')->references('id')->on('tipo_manutencaos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_correcao_id')->references('id')->on('tipo_correcaos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lancamento_multas');
    }
}
