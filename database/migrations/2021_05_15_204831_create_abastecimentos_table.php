<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAbastecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abastecimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tipo_combustivel_id');
            $table->unsignedInteger('fornecedor_id');
            $table->double('km_atual')->nullable();
            $table->string('responsavel')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tipo_combustivel_id')->references('id')->on('tipo_combustivels')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('abastecimentos');
    }
}
