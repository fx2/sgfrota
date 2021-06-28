<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoCombustivelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_combustivels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome')->nullable();
            $table->text('descricao')->nullable();
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
        Schema::drop('tipo_combustivels');
    }
}
