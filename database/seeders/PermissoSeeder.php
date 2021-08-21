<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crudr = ['Visualizar', 'Adicionar', 'Editar', 'Deletar', 'Relatorio'];
        for ($i = 0; $i < COUNT($crudr); $i++) {
            DB::table('permissoes')->insert(['titulo' => 'Fornecedor', 'quem_pertence' => 'FORNECEDOR', 'chave_ordem' => 'FORNECEDOR', 'ordem_exibicao' => NULL, 'avo' => 'FORNECEDOR', 'permissao_direta' => 1, 'descricao' => $crudr[$i], 'pai' => NULL,
                'status' => 0, 'created_at' => '2019-10-31 13:39:37', 'updated_at' => '2019-10-31 13:39:37', 'deleted_at' => NULL]);
        }

        for ($i = 0; $i < COUNT($crudr); $i++) {
            DB::table('permissoes')->insert(['titulo' => 'Controle de Frotas', 'quem_pertence' => 'CONTROLEDEFROTAS', 'chave_ordem' => 'CONTROLEDEFROTAS', 'ordem_exibicao' => NULL, 'avo' => 'CONTROLEDEFROTAS', 'permissao_direta' => 1, 'descricao' => $crudr[$i], 'pai' => NULL, 'status' => 1, 'created_at' => '2019-10-31 13:39:37', 'updated_at' => '2019-10-31 13:39:37', 'deleted_at' => NULL]);
        }

        for ($i = 0; $i < COUNT($crudr); $i++) {
            DB::table('permissoes')->insert(['titulo' => 'Abastecimentos', 'quem_pertence' => 'ABASTECIMENTOS', 'chave_ordem' => 'ABASTECIMENTOS', 'ordem_exibicao' => NULL, 'avo' => 'ABASTECIMENTOS', 'permissao_direta' => 1, 'descricao' => $crudr[$i], 'pai' => NULL, 'status' => 1, 'created_at' => '2019-10-31 13:39:37', 'updated_at' => '2019-10-31 13:39:37', 'deleted_at' => NULL]);
        }

        for ($i = 0; $i < COUNT($crudr); $i++) {
            DB::table('permissoes')->insert(['titulo' => 'Motoristas', 'quem_pertence' => 'MOTORISTAS', 'chave_ordem' => 'MOTORISTAS', 'ordem_exibicao' => NULL, 'avo' => 'MOTORISTAS', 'permissao_direta' => 1, 'descricao' => $crudr[$i], 'pai' => NULL, 'status' => 1, 'created_at' => '2019-10-31 13:39:37', 'updated_at' => '2019-10-31 13:39:37', 'deleted_at' => NULL]);
        }

        for ($i = 0; $i < COUNT($crudr); $i++) {
            DB::table('permissoes')->insert(['titulo' => 'Manutenção/Despesas', 'quem_pertence' => 'MANUTENCAODESPESAS', 'chave_ordem' => 'MANUTENCAODESPESAS', 'ordem_exibicao' => NULL, 'avo' => 'MANUTENCAODESPESAS', 'permissao_direta' => 1, 'descricao' => $crudr[$i], 'pai' => NULL, 'status' => 1, 'created_at' => '2019-10-31 13:39:37', 'updated_at' => '2019-10-31 13:39:37', 'deleted_at' => NULL]);
        }

        for ($i = 0; $i < COUNT($crudr); $i++) {
            DB::table('permissoes')->insert(['titulo' => 'Lançamento de Multas', 'quem_pertence' => 'LANCAMENTODEMULTAS', 'chave_ordem' => 'LANCAMENTODEMULTAS', 'ordem_exibicao' => NULL, 'avo' => 'LANCAMENTODEMULTAS', 'permissao_direta' => 1, 'descricao' => $crudr[$i], 'pai' => NULL, 'status' => 1, 'created_at' => '2019-10-31 13:39:37', 'updated_at' => '2019-10-31 13:39:37', 'deleted_at' => NULL]);
        }

        for ($i = 0; $i < COUNT($crudr); $i++) {
            DB::table('permissoes')->insert(['titulo' => 'Controle diário de Saida', 'quem_pertence' => 'CONTROLEDIARIODESAIDA', 'chave_ordem' => 'CONTROLEDIARIODESAIDA', 'ordem_exibicao' => NULL, 'avo' => 'CONTROLEDIARIODESAIDA', 'permissao_direta' => 1, 'descricao' => $crudr[$i], 'pai' => NULL, 'status' => 1, 'created_at' => '2019-10-31 13:39:37', 'updated_at' => '2019-10-31 13:39:37', 'deleted_at' => NULL]);
        }

        for ($i = 0; $i < COUNT($crudr); $i++) {
            DB::table('permissoes')->insert(['titulo' => 'Controle diário de Entrada', 'quem_pertence' => 'CONTROLEDIARIODEENTRADA', 'chave_ordem' => 'CONTROLEDIARIODEENTRADA', 'ordem_exibicao' => NULL, 'avo' => 'CONTROLEDIARIODEENTRADA', 'permissao_direta' => 1, 'descricao' => $crudr[$i], 'pai' => NULL, 'status' => 1, 'created_at' => '2019-10-31 13:39:37', 'updated_at' => '2019-10-31 13:39:37', 'deleted_at' => NULL]);
        }

        for ($i = 0; $i < COUNT($crudr); $i++) {
            DB::table('permissoes')->insert(['titulo' => 'Agendamento de Veículos', 'quem_pertence' => 'AGENDAMENTODEVEICULOS', 'chave_ordem' => 'AGENDAMENTODEVEICULOS', 'ordem_exibicao' => NULL, 'avo' => 'AGENDAMENTODEVEICULOS', 'permissao_direta' => 1, 'descricao' => $crudr[$i], 'pai' => NULL, 'status' => 1, 'created_at' => '2019-10-31 13:39:37', 'updated_at' => '2019-10-31 13:39:37', 'deleted_at' => NULL]);
        }

        for ($i = 0; $i < COUNT($crudr); $i++) {
            DB::table('permissoes')->insert(['titulo' => 'Admin Agendamento de Veículos', 'quem_pertence' => 'ADMINAGENDAMENTODEVEICULOS', 'chave_ordem' => 'ADMINAGENDAMENTODEVEICULOS', 'ordem_exibicao' => NULL, 'avo' => 'ADMINAGENDAMENTODEVEICULOS', 'permissao_direta' => 1, 'descricao' => $crudr[$i], 'pai' => NULL, 'status' => 1, 'created_at' => '2019-10-31 13:39:37', 'updated_at' => '2019-10-31 13:39:37', 'deleted_at' => NULL]);
        }

        for ($i = 0; $i < COUNT($crudr); $i++) {
            DB::table('permissoes')->insert(['titulo' => 'Vale Combustíveis e Lavagens', 'quem_pertence' => 'VALECOMBUSTIVEISLAVAGENS', 'chave_ordem' => 'VALECOMBUSTIVEISLAVAGENS', 'ordem_exibicao' => NULL, 'avo' => 'VALECOMBUSTIVEISLAVAGENS', 'permissao_direta' => 1, 'descricao' => $crudr[$i], 'pai' => NULL, 'status' => 1, 'created_at' => '2019-10-31 13:39:37', 'updated_at' => '2019-10-31 13:39:37', 'deleted_at' => NULL]);
        }

        for ($i = 0; $i < COUNT($crudr); $i++) {
            DB::table('permissoes')->insert(['titulo' => 'Veículo Reserva Entrada', 'quem_pertence' => 'VEICULORESERVAENTRADA', 'chave_ordem' => 'VEICULORESERVAENTRADA', 'ordem_exibicao' => NULL, 'avo' => 'VEICULORESERVAENTRADA', 'permissao_direta' => 1, 'descricao' => $crudr[$i], 'pai' => NULL, 'status' => 1, 'created_at' => '2019-10-31 13:39:37', 'updated_at' => '2019-10-31 13:39:37', 'deleted_at' => NULL]);
        }

        for ($i = 0; $i < COUNT($crudr); $i++) {
            DB::table('permissoes')->insert(['titulo' => 'Veículo Reserva Devolução', 'quem_pertence' => 'VEICULORESERVADEVOLUCAO', 'chave_ordem' => 'VEICULORESERVADEVOLUCAO', 'ordem_exibicao' => NULL, 'avo' => 'VEICULORESERVADEVOLUCAO', 'permissao_direta' => 1, 'descricao' => $crudr[$i], 'pai' => NULL, 'status' => 1, 'created_at' => '2019-10-31 13:39:37', 'updated_at' => '2019-10-31 13:39:37', 'deleted_at' => NULL]);
        }
    }
}
