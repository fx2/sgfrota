@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item">Veiculo Reserva Devolução</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header h3">Veiculo Reserva Devolução</div>
        <div class="card-body">
{{--            @can('checksetor', VEICULORESERVADEVOLUCAO_ADICIONAR)--}}
{{--                <a href="{{ url('/veiculo-reserva-devolucao/create') }}" class="btn btn-success btn-sm" title="Add New VeiculoReservaDevolucao">--}}
{{--                    <i class="fa fa-plus" aria-hidden="true"></i> Adicionar--}}
{{--                </a>--}}
{{--            @endcan--}}

            <form method="GET" action="{{ url('veiculo-reserva-devolucao/custom/listagem ') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                            <label>Placa</label>
                                            <input type="text" name="placa" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-2">
                                        <div class="form-group">
                                            <label>Ano Modelo</label>
                                            <input type="text" name="ano_modelo" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-1">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Responsável</label>
                                            <select name="tipo_responsavel_id" class="form-control" id="tipo_responsavel_id" >
                                                <option value="">Selecione ...</option>
                                                @foreach ($selectModelFields['TipoResponsavel'] as $optionKey => $optionValue)
                                                    <option value="{{ $optionValue->id }}"
                                                        {{ (isset($result->tipo_responsavel_id) && $result->tipo_responsavel_id == $optionValue->id) ? 'selected' : ''}}
                                                        {{ old('tipo_responsavel_id') == $optionValue->id ? "selected" : "" }}
                                                    >{{ $optionValue->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-4">
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tipo_veiculo" id="Proprio" value="1">
                                                <label class="form-check-label" for="Proprio">
                                                    Próprio
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tipo_veiculo" id="Alugado" value="0">
                                                <label class="form-check-label" for="Alugado">
                                                    Alugado
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tipo_veiculo" id="todos" value="" checked>
                                                <label class="form-check-label" for="todos">
                                                    Todos
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-1">
                                        @include('parts/select-setor-index')
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-warning mr-4" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary without-pdf">Filtrar listagem</button>
                                @can('checksetor', VEICULORESERVADEVOLUCAO_RELATORIO)
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
                        <th>#</th>
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
                            @if($item->deleted_at )
                                <tr style="background-color: lightsalmon">
                            @else
                                <tr>
                            @endif
                                <td>{{ $loop->iteration }}</td>
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

                                                $valor = $item->$a->$b;

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
                                    @if(!$item->deleted_at)
                                        {{-- <a href="{{ url('/veiculo-reserva-devolucao/' . $item->id) }}" title="Visualizar VeiculoReservaDevolucao"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a> --}}
                                        @can('checksetor', VEICULORESERVADEVOLUCAO_EDITAR)
                                            <a href="{{ url('/veiculo-reserva-devolucao/' . $item->id . '/edit') }}" title="Editar VeiculoReservaDevolucao"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                                        @endcan

{{--                                    @can('checksetor', VEICULORESERVADEVOLUCAO_DELETAR)--}}
{{--                                        <button type="submit" data-id="{{ $item->id }}" data-route="/veiculo-reserva-devolucao" class="btnDeletar btn btn-danger btn-sm" title="Deletar VeiculoReservaDevolucao"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
{{--                                    @endcan--}}
                                    @else
                                        @can('checksetor', VEICULORESERVADEVOLUCAO_RELATORIO)
                                            <a href="{{ url('/veiculo-reserva-devolucao/custom/show/pdf/' . $item->id) }}" title="Visualizar PDF Controle diário de saída"><button class="btn btn-secondary btn-sm"><i class="fas fa-file-pdf" aria-hidden="true"></i></button></a>
                                        @endcan
                                        <a href="{{ url('/veiculo-reserva-devolucao/' . $item->id) }}" title="Visualizar Veiculo Reserva Devolucao"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <p class="p-1 hide-thead" onload="hideThead()">Nenhum Veiculo Reserva Devolução encontrado</p>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $results->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
@endsection
