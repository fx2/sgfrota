<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks');


Route::resource('user', 'App\Http\Controllers\Admin\UserController');
Route::resource('fornecedor', 'App\Http\Controllers\Admin\FornecedorController');
Route::resource('tipo-combustivel', 'App\Http\Controllers\Admin\TipoCombustivelController');
Route::resource('tipo-manutencao', 'App\Http\Controllers\Admin\TipoManutencaoController');
Route::resource('tipo-veiculo', 'App\Http\Controllers\Admin\TipoVeiculoController');
Route::resource('marca', 'App\Http\Controllers\Admin\MarcaController');
Route::resource('tipo-multas', 'App\Http\Controllers\Admin\TipoMultasController');
Route::resource('modelo', 'App\Http\Controllers\Admin\ModeloController');
Route::resource('tipo-cnh', 'App\Http\Controllers\Admin\TipoCnhController');
Route::resource('abastecimento', 'App\Http\Controllers\Admin\AbastecimentoController');
Route::resource('motorista', 'App\Http\Controllers\Admin\MotoristaController');
Route::resource('tipo-correcao', 'App\Http\Controllers\Admin\TipoCorrecaoController');
Route::resource('manutencao', 'App\Http\Controllers\Admin\ManutencaosController');
Route::resource('lancamento-multas', 'App\Http\Controllers\Admin\LancamentoMultasController');
Route::resource('controle-frota', 'App\Http\Controllers\Admin\ControleFrotaController');
Route::resource('veiculo-saida', 'App\Http\Controllers\Admin\VeiculoSaidaController');
Route::resource('veiculo-entrada', 'App\Http\Controllers\Admin\VeiculoEntradaController');
Route::resource('setor', 'App\Http\Controllers\Admin\SetorController');
Route::resource('veiculo-agendamento', 'App\Http\Controllers\Admin\VeiculoAgendamentoController');
Route::resource('tipo-responsavel', 'App\Http\Controllers\Admin\TipoResponsavelController');
Route::resource('perfil', 'App\Http\Controllers\Configuracoes\PerfilController');
Route::resource('permissoes', 'App\Http\Controllers\Configuracoes\PermissoesController');
Route::resource('permissoes-usuario', 'App\Http\Controllers\Configuracoes\PermissoesUsuarioController');

Route::get('generate-pdf', [App\Http\Controllers\Admin\PDFController::class, 'generatePDF']);


Route::resource('users', 'App\Http\Controllers\Configuracoes\UsersController');

Route::resource('country', 'App\Http\Controllers\Admin\CountryController');
Route::resource('state', 'App\Http\Controllers\Admin\StateController');
Route::resource('city', 'App\Http\Controllers\Admin\CityController');
Route::resource('vale-combustiveis-lavagens', 'App\Http\Controllers\Admin\ValeCombustiveisLavagensController');
Route::resource('veiculo-reserva-entrada', 'App\Http\Controllers\Admin\VeiculoReservaEntradaController');
Route::resource('veiculo-reserva-entrada', 'App\Http\Controllers\Admin\VeiculoReservaEntradaController');
Route::resource('veiculo-reserva-devolucao', 'App\Http\Controllers\Admin\VeiculoReservaDevolucaoController');
Route::resource('activity-log', 'App\Http\Controllers\Configuracoes\ActivityLogController');
Route::resource('agenda', 'App\Http\Controllers\Admin\AgendaController');
Route::resource('solicitacoes', 'App\Http\Controllers\Admin\SolicitacoesController');
Route::resource('tipo-solicitacao', 'App\Http\Controllers\Admin\TipoSolicitacaoController');


Route::resource('/xtests-pdf', 'App\Http\Controllers\TestesPdfController');