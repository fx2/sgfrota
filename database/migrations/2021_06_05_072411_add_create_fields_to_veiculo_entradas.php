<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreateFieldsToVeiculoEntradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('veiculo_entradas', function (Blueprint $table) {
            $table->unsignedInteger('motorista_id');
            $table->boolean('mecanica')->nullable()->after('status');
            $table->boolean('eletrica')->nullable()->after('status');
            $table->boolean('funilaria')->nullable()->after('status');
            $table->boolean('pintura')->nullable()->after('status');
            $table->boolean('pneus')->nullable()->after('status');
            $table->text('observacao_situacao')->nullable()->after('status');
            $table->boolean('macaco')->nullable()->after('status');
            $table->boolean('triangulo')->nullable()->after('status');
            $table->boolean('estepe')->nullable()->after('status');
            $table->boolean('extintor')->nullable()->after('status');
            $table->boolean('chave_roda')->nullable()->after('status');
            $table->text('observacao_acessorio')->nullable()->after('status');
            $table->date('entrada_data')->nullable()->default(NULL)->after('status');
            $table->time('entrada_hora')->after('status');
            $table->foreign('motorista_id')->references('id')->on('motoristas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('veiculo_entradas', function (Blueprint $table) {
            //
        });
    }
}
