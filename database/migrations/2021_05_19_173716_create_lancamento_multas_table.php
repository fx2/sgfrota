<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLancamentoMultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lancamento_multas', function (Blueprint $table) { $table->increments('id');
            $table->unsignedInteger('motorista_id');
            $table->unsignedInteger('tipo_multa_id');
            $table->string('ocorrencias')->nullable();
            $table->string('numero_ait')->nullable();
            $table->integer('estado_id')->nullable();
            $table->integer('municipio_id')->nullable();
            $table->string('endereco_multa')->nullable();
            $table->date('data_multa')->nullable();
            $table->time('hora_multa')->nullable();
            $table->string('orgao_correspondente')->nullable();
            $table->string('enquadramento')->nullable();
            $table->date('data_vencimento')->nullable();
            $table->double('valor_multa')->nullable();
            $table->boolean('pago')->nullable();
            $table->string('foto_multa')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('motorista_id')->references('id')->on('motoristas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_multa_id')->references('id')->on('tipo_multas')->onDelete('cascade')->onUpdate('cascade');
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
