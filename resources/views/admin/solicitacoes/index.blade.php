@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item">Solicitacões</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header h3">Solicitacões</div>
        <div class="card-body">
            @can('checksetor', SOLICITACOES_ADICIONAR)
                <a href="{{ url('/solicitacoes/create') }}" class="btn btn-success btn-sm" title="Add New Solicitaco">
                    <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                </a>
            @endcan

            <form method="GET" action="{{ url('/solicitacoes/custom/listagem') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                <div class="input-group">
                    <span class="input-group-append">
                        <button type="button" class="btn btn-primary rounded" data-toggle="modal" data-target="#exampleModal">
                          Filtrar
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Filtrar Listagem</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="row">

                                    <div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-2">
                                        <div class="form-group">
                                            <label for="prioridade">Prioridade</label>
                                            <select name="prioridade" class="form-control" id="prioridade">
                                                <option value="">Selecione ...</option>
                                                <option value="1">Alta</option>
                                                <option value="2">Normal</option>
                                                <option value="3">Baixa</option>    
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-2">
                                        <div class="form-group">
                                            <label for="solicitacao_id">Solicitação</label>
                                            <select name="solicitacao_id" class="form-control" id="solicitacao_id">
                                                <option value="">Selecione ...</option>
                                                @foreach ($selectModelFields['tipoSolicitacao'] as $optionKey => $optionValue)
                                                    <option value="{{ $optionValue->id }}" 
                                                    >{{ $optionValue->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-2">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Status</label>
                                            <select name="status" class="form-control" id="status">
                                                <option value="">Selecione ...</option>
                                                <option value="1">Aberto</option>
                                                <option value="0">Finalizado</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-2">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Data inícial</label>
                                            <input type="text" name="data_inicial" class="form-control data">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-2">
                                        <div class="form-group">
                                            <label>Data Final</label>
                                            <input type="text" name="data_final" class="form-control data">
                                        </div>
                                    </div>

                                    @include('parts/select-setor-index')
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-warning mr-4" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary without-pdf">Filtrar listagem</button>
                                @can('checksetor', SOLICITACOES_RELATORIO)
                                    <input type="hidden" class="form-control" name="export_pdf" placeholder="Buscar...">
                                    <button class="ml-3 btn btn-secondary export-pdf" type="submit">
                                        <i class="fas fa-file-pdf"></i> Filtrar PDF
                                    </button>
                                @endcan
                              </div>
                            </div>
                          </div>
                        </div>
                    </span>
                </div>
            </form>

            <br/>
            <br/>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-hide">
                        @can('isMasterOrAdmin')
                            <th>Setor</th>
                        @endcan
                        @foreach ($titles as $item)
                            <th>{{ $item }}</th>
                        @endforeach
                        <th>Ações</th>
                    </thead>
                    <tbody>
                        @forelse($results as $item)
                            @if ($item->etapa == 2)
                                <tr style="background-color: orange;">
                            @elseif ($item->etapa == 3)
                                <tr style="background-color: lightgreen;">
                            @else
                                <tr>
                            @endif
                                @can('isMasterOrAdmin')
                                    <td>{{$item->setor->nome}}</td>
                                @endcan
                                    @foreach ($fields as $key => $val)
                                        <td class="borda" scope="row">
                                            @php
                                            // da pra melhorar esses if e fazer um loop, mas nao quero
                                            if (!empty($val[0])){
                                                $a = $val[0];
                                                $valor = $item->$a;

                                                if ($val[0] == 'status') {
                                                    $valor = $valor == 1 ? 'Aberto' : 'Finalizado';
                                                }
                                                elseif ($val[0] == 'prioridade') {
                                                    
                                                    if ($valor == 1)
                                                        $valor = 'Alta';
                                                    if ($valor == 2)
                                                        $valor = 'Normal';
                                                    if ($valor == 3)
                                                        $valor = 'Baixa';
                                                }
                                                elseif ($val[0] == 'data') {
                                                    $valor = convertTimestamp($valor, 'd/m/Y');
                                                }
                                                elseif ($val[0] == 'horario') {
                                                    $valor = convertTimestamp($valor, 'H:i');
                                                }
                                                elseif ($val[0] == 'respondendo_data') {
                                                    $valor = convertTimestamp($valor, 'd/m/Y');
                                                }
                                                elseif ($val[0] == 'respondendo_horario') {
                                                    $valor = convertTimestamp($valor, 'H:i');
                                                }

                                            }

                                            if (!empty($val[1])){
                                                $a = $val[0];
                                                $b = $val[1];

                                                $valor = $item->$a->$b;

                                                if ($val[1] == 'status') {
                                                    $valor = $valor == 1 ? 'Aberto' : 'Finalizado';
                                                }
                                                elseif ($val[1] == 'prioridade') {
                                                    if ($valor == 1)
                                                        $valor == 'Alta';
                                                    if ($valor == 2)
                                                        $valor == 'Normal';
                                                    if ($valor == 3)
                                                        $valor == 'Baixa';
                                                }
                                                elseif ($val[1] == 'data') {
                                                    $valor = convertTimestamp($valor, 'd/m/Y');
                                                }
                                                elseif ($val[1] == 'horario') {
                                                    $valor = convertTimestamp($valor, 'H:i');
                                                }
                                                elseif ($val[1] == 'respondendo_data') {
                                                    $valor = convertTimestamp($valor, 'd/m/Y');
                                                }
                                                elseif ($val[1] == 'respondendo_horario') {
                                                    $valor = convertTimestamp($valor, 'H:i');
                                                }
                                            }

                                            if (!empty($val[2])){
                                                $a = $val[0];
                                                $b = $val[1];
                                                $c = $val[2];

                                                $valor = $item->$a->$b->$c;

                                                if ($val[2] == 'status') {
                                                    $valor = $valor == 1 ? 'Aberto' : 'Finalizado';
                                                }
                                                elseif ($val[2] == 'prioridade') {
                                                    if ($valor == 1)
                                                        $valor == 'Alta';
                                                    if ($valor == 2)
                                                        $valor == 'Normal';
                                                    if ($valor == 3)
                                                        $valor == 'Baixa';
                                                }
                                                elseif ($val[2] == 'data') {
                                                    $valor = convertTimestamp($valor, 'd/m/Y');
                                                }
                                                elseif ($val[2] == 'horario') {
                                                    $valor = convertTimestamp($valor, 'H:i');
                                                }
                                                elseif ($val[2] == 'respondendo_data') {
                                                    $valor = convertTimestamp($valor, 'd/m/Y');
                                                }
                                                elseif ($val[2] == 'respondendo_horario') {
                                                    $valor = convertTimestamp($valor, 'H:i');
                                                }
                                            }

                                            if (!empty($val[3])){
                                                $a = $val[0];
                                                $b = $val[1];
                                                $c = $val[2];
                                                $d = $val[3];

                                                $valor = $item->$a->$b->$c->$d;

                                                if ($val[3] == 'status') {
                                                    $valor = $valor == 1 ? 'Aberto' : 'Finalizado';
                                                }
                                                elseif ($val[3] == 'prioridade') {
                                                    if ($valor == 1)
                                                        $valor == 'Alta';
                                                    if ($valor == 2)
                                                        $valor == 'Normal';
                                                    if ($valor == 3)
                                                        $valor == 'Baixa';
                                                }
                                                elseif ($val[3] == 'data') {
                                                    $valor = convertTimestamp($valor, 'd/m/Y');
                                                }
                                                elseif ($val[3] == 'horario') {
                                                    $valor = convertTimestamp($valor, 'H:i');
                                                }
                                                elseif ($val[3] == 'respondendo_data') {
                                                    $valor = convertTimestamp($valor, 'd/m/Y');
                                                }
                                                elseif ($val[3] == 'respondendo_horario') {
                                                    $valor = convertTimestamp($valor, 'H:i');
                                                }
                                            }

                                            if (!empty($val[4])){
                                                $a = $val[0];
                                                $b = $val[1];
                                                $c = $val[2];
                                                $d = $val[3];
                                                $e = $val[4];

                                                $valor = $item->$a->$b->$c->$d->$e;

                                                if ($val[4] == 'status') {
                                                    $valor = $valor == 1 ? 'Aberto' : 'Finalizado';
                                                }
                                                elseif ($val[4] == 'prioridade') {
                                                    if ($valor == 1)
                                                        $valor == 'Alta';
                                                    if ($valor == 2)
                                                        $valor == 'Normal';
                                                    if ($valor == 3)
                                                        $valor == 'Baixa';
                                                }
                                                elseif ($val[4] == 'data') {
                                                    $valor = convertTimestamp($valor, 'd/m/Y');
                                                }
                                                elseif ($val[4] == 'horario') {
                                                    $valor = convertTimestamp($valor, 'H:i');
                                                }
                                                elseif ($val[4] == 'respondendo_data') {
                                                    $valor = convertTimestamp($valor, 'd/m/Y');
                                                }
                                                elseif ($val[4] == 'respondendo_horario') {
                                                    $valor = convertTimestamp($valor, 'H:i');
                                                }
                                            }
                                            @endphp

                                            {{$valor}}
                                        </td>
                                    @endforeach
                                <td>
                                    {{-- <a href="{{ url('/solicitacoes/' . $item->id) }}" title="Visualizar Solicitaco"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a> --}}
                                    @if ($item->etapa != 3)
                                        @can('checksetor', SOLICITACOES_EDITAR)
                                            <a href="{{ url('/solicitacoes/' . $item->id . '/edit') }}" title="Editar Solicitação"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                                        @endcan

                                        @can('checksetor', SOLICITACOES_DELETAR)
                                            @if ($item->auth_id == auth('api')->user()->id)
                                                <button type="submit" data-id="{{ $item->id }}" data-route="/solicitacoes" class="btnDeletar btn btn-danger btn-sm" title="Deletar Solicitaco"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            @endif
                                        @endcan
                                    @else
                                        <a href="{{ url('/solicitacoes/' . $item->id) }}" title="Visualizar Solicitaco"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <p class="p-1 hide-thead" onload="hideThead()">Nenhuma Solicitacão encontrada</p>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $results->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
@endsection
