<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreateResponsavelToControleFrotum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('controle_frotas', function (Blueprint $table) {
            $table->unsignedInteger('tipo_responsavel_id');
            $table->foreign('tipo_responsavel_id')->references('id')->on('tipo_responsavels')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('controle_frotas', function (Blueprint $table) {
            //
        });
    }
}
