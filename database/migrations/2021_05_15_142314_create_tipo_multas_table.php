<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoMultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_multas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo')->nullable();
            $table->text('descricao')->nullable();
            $table->integer('pontuacao')->nullable();
            $table->string('infrator')->nullable();
            $table->string('codigo')->nullable();
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
        Schema::drop('tipo_multas');
    }
}
