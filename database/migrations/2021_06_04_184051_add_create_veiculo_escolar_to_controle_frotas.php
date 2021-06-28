<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreateVeiculoEscolarToControleFrotas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('controle_frotas', function (Blueprint $table) {
            $table->boolean('veiculo_escolar')->nullable()->after('disponivel_outros_departamentos');
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
