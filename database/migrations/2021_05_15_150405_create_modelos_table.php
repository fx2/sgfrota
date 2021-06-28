<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('tipo_veiculo_id');
            $table->unsignedInteger('marca_id');
            $table->string('modelo')->nullable();
            $table->text('descricao')->nullable();
            $table->boolean('status')->nullable();
            $table->foreign('tipo_veiculo_id')->references('id')->on('tipo_veiculos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('modelos');
    }
}
