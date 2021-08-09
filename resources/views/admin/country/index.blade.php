@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item">Country</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header h3">Country</div>
        <div class="card-body">
            @can('checksetor', _ADICIONAR)
                <a href="{{ url('/country/create') }}" class="btn btn-success btn-sm" title="Add New Country">
                    <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                </a>
            @endcan

            <form method="GET" action="{{ url('/country') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                    <span class="input-group-append">
                        <button class="btn btn-success without-pdf" type="submit">
                            <i class="fa fa-search"></i>
                        </button>

                        @can('checksetor', _RELATORIO)
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
                            <tr>
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
                                    {{-- <a href="{{ url('/country/' . $item->id) }}" title="Visualizar Country"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a> --}}
                                    @can('checksetor', _EDITAR)
                                        <a href="{{ url('/country/' . $item->id . '/edit') }}" title="Editar Country"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                                    @endcan

                                    @can('checksetor', _DELETAR)
                                        <button type="submit" data-id="{{ $item->id }}" data-route="/country" class="btnDeletar btn btn-danger btn-sm" title="Deletar Country"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <p class="p-1 hide-thead" onload="hideThead()">Nenhum Country encontrado</p>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $results->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
@endsection
