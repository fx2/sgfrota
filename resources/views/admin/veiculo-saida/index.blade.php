@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item">Controle Diário de Saída</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header h3">Controle Diário de Saída</div>
        <div class="card-body">
            @can('checksetor', CONTROLEDIARIODESAIDA_ADICIONAR)
                <a href="{{ url('/veiculo-saida/create') }}" class="btn btn-success btn-sm" title="Add New Controle diário de saída">
                    <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                </a>
            @endcan

            <form method="GET" action="{{ url('/veiculo-saida/custom/listagem ') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                @can('checksetor', CONTROLEDIARIODESAIDA_RELATORIO)
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
                                    <td>{{$item->motorista->nome}}</td>
                                    <td>{{$item->controle_frota->veiculo}}</td>
                                    <td>{{$item->nome_responsavel}}</td>
                                    <td>{{$item->status == 1 ? 'Ativo' : 'Bloqueado'}}</td>
                                <td>
                                    {{-- <a href="{{ url('/veiculo-saida/' . $item->id) }}" title="Visualizar Controle diário de saída"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a> --}}
                                    @can('checksetor', CONTROLEDIARIODESAIDA_EDITAR)
                                        <a href="{{ url('/veiculo-saida/' . $item->id . '/edit') }}" title="Editar Controle diário de saída"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                                    @endcan

                                    @can('checksetor', CONTROLEDIARIODESAIDA_DELETAR)
                                        <button type="submit" data-id="{{ $item->id }}" data-route="/veiculo-saida" class="btnDeletar btn btn-danger btn-sm" title="Deletar Controle diário de saída"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <p class="p-1 hide-thead" onload="hideThead()">Nenhum Controle Diário de Saída encontrado</p>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $results->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
@endsection
