<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthIdRegistroToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abastecimentos', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('controle_frotas', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('fornecedors', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('lancamento_multas', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('manutencaos', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('marcas', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('modelos', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('motoristas', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('perfils', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('permissoes', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('permissoes_usuarios', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('tipo_cnhs', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('tipo_combustivels', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('tipo_correcaos', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('tipo_manutencaos', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('tipo_multas', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('tipo_responsavels', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('tipo_veiculos', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('users', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('vale_combustiveis_lavagens', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
//        Schema::table('veiculo_agendamentos', function ($table) {
//            $table->unsignedInteger('auth_id')->nullable();
//        });
        Schema::table('veiculo_entradas', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });
        Schema::table('veiculo_saidas', function ($table) {
            $table->unsignedInteger('auth_id')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
}
