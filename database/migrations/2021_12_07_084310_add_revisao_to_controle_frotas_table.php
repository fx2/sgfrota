<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRevisaoToControleFrotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('controle_frotas', function (Blueprint $table) {
            $table->decimal('revisao_com_km', 16, 4)->nullable();
            $table->date('revisao_com_data')->nullable();
            $table->date('vencimento_licenciamento')->nullable();

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
