<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatus1ToAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('type')->default('colaborador')->change();
            $table->softDeletes();
        });

        Schema::table('abastecimentos', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('controle_frotas', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('fornecedors', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('lancamento_multas', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('manutencaos', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('marcas', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('modelos', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('motoristas', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('perfils', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('permissoes', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('permissoes_usuarios', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('setors', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('tipo_cnhs', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('tipo_combustivels', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('tipo_correcaos', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('tipo_manutencaos', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('tipo_multas', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('tipo_responsavels', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('tipo_veiculos', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('veiculo_agendamentos', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('veiculo_entradas', function ($table) {
            $table->boolean('status')->default(1)->change();
        });

        Schema::table('veiculo_saidas', function ($table) {
            $table->boolean('status')->default(1)->change();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('all_tables', function (Blueprint $table) {
            //
        });
    }
}
