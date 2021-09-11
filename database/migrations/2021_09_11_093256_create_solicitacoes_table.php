<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSolicitacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('solicitacao_id');
            $table->string('user_id');
            $table->string('setor_id');
            $table->string('sequencia')->nullable();
            $table->date('data')->nullable();
            $table->time('horario')->nullable();
            $table->string('prioridade');
            $table->string('numero_oficio')->nullable();
            $table->text('descricao')->nullable();
            $table->string('documento')->nullable();
            $table->text('respondendo_descricao')->nullable();
            $table->integer('respondendo_user_id')->nullable();
            $table->date('respondendo_data')->nullable();
            $table->time('respondendo_horario')->nullable();
            $table->string('respondendo_documento')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('solicitacoes');
    }
}
