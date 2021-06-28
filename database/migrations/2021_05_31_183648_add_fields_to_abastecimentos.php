<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToAbastecimentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abastecimentos', function (Blueprint $table) {
            $table->double('qtd_litros')->after('foto');
            $table->double('valor')->after('foto');
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
            $table->dropColumn('qtd_litros');
            $table->dropColumn('valor');
        });
    }
}
