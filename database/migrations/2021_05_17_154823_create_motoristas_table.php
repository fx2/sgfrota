<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMotoristasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motoristas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('motorista_escolar');
            $table->string('tipo_motorista')->default('Carro');
            $table->string('certificado_transporte_escolar')->nullable();
            $table->date('data_conclusao_curso')->nullable();
            $table->unsignedInteger('fornecedor_id');
            $table->string('nome');
            $table->string('rg');
            $table->string('cpf');
            $table->date('data_nascimento');
            $table->string('email');
            $table->string('telefone');
            $table->string('celular');
            $table->string('imagem')->nullable();
            $table->string('cnh');
            $table->unsignedInteger('tipo_cnh_id')->nullable();
            $table->date('cnh_primeira');
            $table->date('cnh_validade');
            $table->date('cnh_emissao');
            $table->string('cnh_imagem');
            $table->integer('avisar_antes_qtddias')->nullable();
            $table->text('observacoes')->nullable();
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_cnh_id')->references('id')->on('tipo_cnhs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('motoristas');
    }
}
