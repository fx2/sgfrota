@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item">Controle Diário de Entrada</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header h3">Controle Diário de Entrada</div>
        <div class="card-body">
            @can('checksetor', CONTROLEDIARIODEENTRADA_ADICIONAR)
                <a href="{{ url('/veiculo-entrada/create') }}" class="btn btn-success btn-sm" title="Add New VeiculoEntrada">
                    <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                </a>
            @endcan

            <form method="GET" action="{{ url('/veiculo-entrada/custom/listagem ') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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

                                    @include('parts/controle-frotas-index')

                                    @include('parts/motorista-index')

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
                                @can('checksetor', CONTROLEDIARIODEENTRADA_RELATORIO)
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
                                    <td>{{$item->motorista->nome}}</td>
                                    @if($item->controle_frota_id)
                                        <td>{{$item->controle_frota->veiculo}}</td>
                                        <td>{{$item->controle_frota->placa}}</td>
                                    @else
                                        <td>{{$item->veiculo_reserva_entrada->veiculo}}</td>
                                        <td>{{$item->veiculo_reserva_entrada->placa}}</td>
                                    @endif
                                    <td>{{ convertTimestamp($item->entrada_data, 'd/m/Y') }}</td>
                                    <td>{{ convertTimestamp($item->entrada_hora, 'H:i') }}</td>
                                    <td>{{$item->nome_responsavel}}</td>
                                <td>
                                    @can('checksetor', CONTROLEDIARIODESAIDA_RELATORIO)
                                        <a href="{{ url('/veiculo-entrada/custom/show/pdf/' . $item->id) }}" title="Visualizar PDF Controle diário de saída"><button class="btn btn-secondary btn-sm"><i class="fas fa-file-pdf" aria-hidden="true"></i></button></a>
                                     @endcan
                                     <a href="{{ url('/veiculo-entrada/' . $item->id) }}" title="Visualizar VeiculoEntrada"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
{{--                                    @can('checksetor', CONTROLEDIARIODEENTRADA_EDITAR)--}}
{{--                                        <a href="{{ url('/veiculo-entrada/' . $item->id . '/edit') }}" title="Editar VeiculoEntrada"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>--}}
{{--                                    @endcan--}}

{{--                                    @can('checksetor', CONTROLEDIARIODEENTRADA_DELETAR)--}}
{{--                                        <button type="submit" data-id="{{ $item->id }}" data-route="/veiculo-entrada" class="btnDeletar btn btn-danger btn-sm" title="Deletar VeiculoEntrada"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
{{--                                    @endcan--}}
                                </td>
                            </tr>
                        @empty
                            <p class="p-1 hide-thead" onload="hideThead()">Nenhum Controle Diário de Entrada encontrado</p>
                        @endforelse
                    </tbody>
                </table>
                @if (isset($filters))
                    {!! $results->appends($filters)->links() !!}
                @else
                    {!! $results->links() !!}
                @endif
            </div>

        </div>
    </div>
@endsection
