<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldsToAbastecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abastecimentos', function (Blueprint $table) {
            $table->unsignedInteger('tipo_combustivel_id')->nullable()->change();
            $table->unsignedInteger('fornecedor_id')->nullable()->change();
            $table->decimal('valor', 15,2)->nullable()->change();
            $table->decimal('qtd_litros', 15,2)->nullable()->change();
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
