<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateControleFrotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controle_frotas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tipo_veiculo_id');
            $table->unsignedInteger('tipo_combustivel_id');
            $table->unsignedInteger('marca_id');
            $table->unsignedInteger('modelo_id');
            $table->boolean('tipo_veiculo');
            $table->string('nome_proprietario')->nullable();
            $table->boolean('disponivel_outros_departamentos');
            $table->boolean('veiculo_escolar');
            $table->string('certificado_vistoria')->nullable();
            $table->date('vencto_vistoria_escolar')->nullable();
            $table->string('renavan');
            $table->string('placa');
            $table->string('chassi');
            $table->string('especie_tipo');
            $table->string('veiculo');
            $table->date('ano_fabricacao');
            $table->date('ano_modelo');
            $table->string('capacidade');
            $table->string('cor');
            $table->string('patrimonio');
            $table->text('estado_veiculo');
            $table->integer('km_inicial');
            $table->string('dut');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tipo_veiculo_id')->references('id')->on('tipo_veiculos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_combustivel_id')->references('id')->on('tipo_combustivels')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('controle_frotas');
    }
}
