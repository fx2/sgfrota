<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVeiculoReservaEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculo_reserva_entradas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('tipo_veiculo_id')->nullable();
            $table->integer('setor_id')->nullable();
            $table->integer('tipo_responsavel_id')->nullable();
            $table->boolean('tipo_responsavel')->nullable();
            $table->integer('tipo_combustivel_id')->nullable();
            $table->integer('marca_id')->nullable();
            $table->integer('modelo_id')->nullable();
            $table->boolean('tipo_veiculo')->nullable();
            $table->string('nome_proprietario')->nullable();
            $table->boolean('disponivel_outros_departamentos')->nullable();
            $table->boolean('veiculo_escolar')->nullable();
            $table->string('certificado_vistoria')->nullable();
            $table->date('vencto_vistoria_escolar')->nullable();
            $table->string('renavan')->nullable();
            $table->string('placa')->nullable();
            $table->string('chassi')->nullable();
            $table->string('especie_tipo')->nullable();
            $table->string('veiculo')->nullable();
            $table->integer('ano_fabricacao')->nullable();
            $table->integer('ano_modelo')->nullable();
            $table->string('capacidade')->nullable();
            $table->string('cor')->nullable();
            $table->string('patrimonio')->nullable();
            $table->text('estado_veiculo')->nullable();
            $table->decimal('km_inicial')->nullable();
            $table->decimal('km_atual')->nullable();
            $table->string('dut')->nullable();
            $table->string('foto')->nullable();
            $table->integer('controle_frota_id')->nullable();
            $table->text('entrada_forma_substituicao')->nullable();
            $table->date('entrada_data')->nullable();
            $table->time('entrada_horario')->nullable();
            $table->double('entrada_km_atual')->nullable();
            $table->string('entrada_combustivel')->nullable();
            $table->string('entrada_recebido_por')->nullable();
            $table->text('entrada_observacao')->nullable();
            $table->integer('auth_id')->nullable();
            $table->boolean('status')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('veiculo_reserva_entradas');
    }
}
