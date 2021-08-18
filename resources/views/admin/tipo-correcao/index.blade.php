@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item">Tipos de correcões</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header h3">Tipos de correcões</div>
        <div class="card-body">
            <a href="{{ url('/tipo-correcao/create') }}" class="btn btn-success btn-sm" title="Add New Tipo de Correção">
                <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
            </a>

            <form method="GET" action="{{ url('/tipo-correcao') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                    <span class="input-group-append">
                        <button class="btn btn-success without-pdf" type="submit">
                            <i class="fa fa-search"></i>
                        </button>

                        <input type="hidden" class="form-control" name="export_pdf" placeholder="Buscar...">
                        <button class="ml-3 btn btn-secondary export-pdf" type="submit">
                            <i class="fas fa-file-pdf"></i>
                        </button>
                    </span>
                </div>
            </form>

            <br/>
            <br/>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-hide">
                        <tr>
{{--                            <th>#</th>--}}
                            @foreach ($titles as $item)
                                <th>{{ $item }}</th>
                            @endforeach
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($results as $item)
                            <tr>
{{--                                <td>{{ $loop->iteration }}</td>--}}
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
                                    {{-- <a href="{{ url('/tipo-correcao/' . $item->id) }}" title="Visualizar Tipo de Correção"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a> --}}
                                    <a href="{{ url('/tipo-correcao/' . $item->id . '/edit') }}" title="Editar Tipo de Correção"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>

                                    <button type="submit" data-id="{{ $item->id }}" data-route="/tipo-correcao" class="btnDeletar btn btn-danger btn-sm" title="Deletar Tipo de Correção"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                        @empty
                            <p class="p-1 hide-thead" onload="hideThead()">Nenhum Tipos de correcao encontõesdo</p>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $results->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
@endsection
