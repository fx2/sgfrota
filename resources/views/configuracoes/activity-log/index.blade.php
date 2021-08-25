@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item">Log de atividades</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header h3">Log de atividades</div>
        <div class="card-body">
            @can('d', ACTIVITYLOG_ADICIONAR)
                <a href="{{ url('/activity-log/create') }}" class="btn btn-success btn-sm" title="Add New Log de atividades">
                    <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                </a>
            @endcan

            <form method="GET" action="{{ url('/activity-log') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                    <span class="input-group-append">
                        <button class="btn btn-success without-pdf" type="submit">
                            <i class="fa fa-search"></i>
                        </button>

                        @can('checksetor', ACTIVITYLOG_RELATORIO)
                            <input type="hidden" class="form-control" name="export_pdf" placeholder="Buscar...">
                            <button class="ml-3 btn btn-secondary export-pdf" type="submit">
                                <i class="fas fa-file-pdf"></i>
                            </button>
                        @endcan
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
                        <th>Nome</th><th>Ferramentas</th>
                    </thead>
                    <tbody>
                        @forelse($results as $item)
                            <tr>
                                @can('isMasterOrAdmin')
                                    <td>{{$item->setor->nome}}</td>
                                @endcan
                                <td>{{ $item->name }}</td>

                                <td>
                                    {{-- <a href="{{ url('/activity-log/' . $item->id) }}" title="Visualizar Log de atividades"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a> --}}
                                    @can('checksetor', ACTIVITYLOG_VISUALIZAR)
                                        <a href="{{ url('/activity-log/' . $item->id ) }}" title="Visualizar Log de atividades"><button class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button></a>
                                    @endcan

{{--                                    @can('checksetor', ACTIVITYLOG_DELETAR)--}}
{{--                                        <button type="submit" data-id="{{ $item->id }}" data-route="/activity-log" class="btnDeletar btn btn-danger btn-sm" title="Deletar Log de atividades"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
{{--                                    @endcan--}}
                                </td>
                            </tr>
                        @empty
                            <p class="p-1 hide-thead" onload="hideThead()">Nenhum Log de atividades encontrado</p>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $results->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
@endsection
