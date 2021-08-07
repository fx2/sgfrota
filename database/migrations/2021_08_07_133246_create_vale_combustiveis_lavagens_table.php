<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateValeCombustiveisLavagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('vale_combustiveis_lavagens', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('setor_id');
            $table->string('tipo_vale');
            $table->unsignedInteger('controle_frota_id');
            $table->double('quantidade_litros')->nullable();
            $table->unsignedInteger('tipo_combustivel_id')->nullable();
            $table->date('data')->nullable();
            $table->time('hour')->nullable();
            $table->string('nome_responsavel')->nullable();
            $table->text('observacao')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vale_combustiveis_lavagens');
    }
}
