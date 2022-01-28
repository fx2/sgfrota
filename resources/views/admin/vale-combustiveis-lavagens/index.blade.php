@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item">Vale de Combustiveis e Lavagens</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header h3">
            <div class="d-flex justify-content-between">
                <span>Vale de Combustiveis e Lavagens</span>
                @isset($quantidadeLitros)
                    <span>Litros: {{ number_format($quantidadeLitros, 0) }} </span>
                @else
                    <span>Litros: {{ number_format(\App\Models\ValeCombustiveisLavagen::sum('quantidade_litros'), 0) }}</span>
                @endisset
            </div>
        </div>
        <div class="card-body">
            @can('checksetor', VALECOMBUSTIVEISLAVAGENS_ADICIONAR)
                <a href="{{ url('/vale-combustiveis-lavagens/create') }}" class="btn btn-success btn-sm" title="Add New ValeCombustiveisLavagen">
                    <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                </a>
            @endcan

            <form method="GET" action="{{ url('vale-combustiveis-lavagens/custom/listagem ') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                <div class="input-group">
{{--                    <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">--}}
                    <span class="input-group-append">
{{--                        <button class="btn btn-success without-pdf" type="submit">--}}
{{--                            <i class="fa fa-search"></i>--}}
{{--                        </button>--}}
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
{{--                                    <div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-2">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="exampleFormControlInput1">Nome do responsável</label>--}}
{{--                                            <input type="text" name="nome_responsavel" class="form-control">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-1">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Veículo</label>
                                            <select name="controle_frota_id" class="form-control" id="controle_frota_id" >
                                                <option value="">Selecione ...</option>
                                                @foreach ($selectModelFields['ControleFrotum'] as $optionKey => $optionValue)
                                                    <option value="{{ $optionValue->id }}"
                                                        {{ (isset($result->controle_frota_id) && $result->controle_frota_id == $optionValue->id) ? 'selected' : ''}}
                                                    >{{ $optionValue->veiculo }} - {{ $optionValue->placa }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-1">
                                        @include('parts/select-setor-index')
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

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-4">
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tipo_vale" id="Abastecimento" value="Abastecimento">
                                                <label class="form-check-label" for="Abastecimento">
                                                    Abastecimento
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tipo_vale" id="Lavagem" value="Lavagem">
                                                <label class="form-check-label" for="Lavagem">
                                                    Lavagem
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tipo_vale" id="todos" value="" checked>
                                                <label class="form-check-label" for="todos">
                                                    Todos
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-warning mr-4" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary without-pdf">Filtrar listagem</button>
                                @can('checksetor', VALECOMBUSTIVEISLAVAGENS_RELATORIO)
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
{{--                        <th>#</th>--}}
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
                            <tr>
{{--                                <td>{{ $loop->iteration }}</td>--}}
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
                                                    $valor = $valor == 1 ? 'Ativo' : 'Bloqueado';
                                                }
                                                elseif ($val[0] == 'data') {
                                                    $valor = convertTimestamp($valor, 'd/m/Y');
                                                }

                                            }

                                            if (!empty($val[1])){
                                                $a = $val[0];
                                                $b = $val[1];

                                                $valor = $item->$a->$b ?? '';

                                                if ($val[1] == 'status') {
                                                    $valor = $valor == 1 ? 'Ativo' : 'Bloqueado';
                                                }
                                                elseif ($val[1] == 'data') {
                                                    $valor = convertTimestamp($valor, 'd/m/Y');
                                                }
                                            }

                                            if (!empty($val[2])){
                                                $a = $val[0];
                                                $b = $val[1];
                                                $c = $val[2];

                                                $valor = $item->$a->$b->$c;

                                                if ($val[2] == 'status') {
                                                    $valor = $valor == 1 ? 'Ativo' : 'Bloqueado';
                                                }
                                                elseif ($val[2] == 'data') {
                                                    $valor = convertTimestamp($valor, 'd/m/Y');
                                                }
                                            }

                                            if (!empty($val[3])){
                                                $a = $val[0];
                                                $b = $val[1];
                                                $c = $val[2];
                                                $d = $val[3];

                                                $valor = $item->$a->$b->$c->$d;

                                                if ($val[3] == 'status') {
                                                    $valor = $valor == 1 ? 'Ativo' : 'Bloqueado';
                                                }
                                                elseif ($val[3] == 'data') {
                                                    $valor = convertTimestamp($valor, 'd/m/Y');
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
                                                    $valor = $valor == 1 ? 'Ativo' : 'Bloqueado';
                                                }
                                                elseif ($val[4] == 'data') {
                                                    $valor = convertTimestamp($valor, 'd/m/Y');
                                                }
                                            }
                                            @endphp

                                            {{$valor}}
                                        </td>
                                    @endforeach
                                <td>
                                    {{-- <a href="{{ url('/vale-combustiveis-lavagens/' . $item->id) }}" title="Visualizar ValeCombustiveisLavagen"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a> --}}
                                    @can('checksetor', VALECOMBUSTIVEISLAVAGENS_EDITAR)
                                        <a href="{{ url('/vale-combustiveis-lavagens/' . $item->id . '/edit') }}" title="Editar ValeCombustiveisLavagen"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                                    @endcan

                                    @can('checksetor', VALECOMBUSTIVEISLAVAGENS_DELETAR)
                                        <button type="submit" data-id="{{ $item->id }}" data-route="/vale-combustiveis-lavagens" class="btnDeletar btn btn-danger btn-sm" title="Deletar Vale combustíveis e Lavagen"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <p class="p-1 hide-thead" onload="hideThead()">Nenhum Vale de Combustiveis e Lavagens encontrado</p>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $results->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
@endsection
