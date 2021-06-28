<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddControleFrotaIdToAbastecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abastecimentos', function (Blueprint $table) {
            $table->unsignedInteger('controle_frota_id')->after('id');

            $table->foreign('controle_frota_id')->references('id')->on('controle_frotas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('abastecimentos', function (Blueprint $table) {
            //
        });
    }
}
