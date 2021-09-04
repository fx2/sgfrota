@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item">Perfil Lista</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header h3">Perfil: {{ $perfil->nome }}</div>
        <div class="card-body">
{{--            <a href="{{ url('/perfil/create') }}" class="btn btn-success btn-sm" title="Add New Perfil">--}}
{{--                <i class="fa fa-plus" aria-hidden="true"></i> Adicionar--}}
{{--            </a>--}}

{{--            <form method="GET" action="{{ url('/perfil') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">--}}
{{--                <div class="input-group">--}}
{{--                    <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">--}}
{{--                    <span class="input-group-append">--}}
{{--                        <button class="btn btn-success without-pdf" type="submit">--}}
{{--                            <i class="fa fa-search"></i>--}}
{{--                        </button>--}}

{{--                        <input type="hidden" class="form-control" name="export_pdf" placeholder="Buscar...">--}}
{{--                        <button class="ml-3 btn btn-secondary export-pdf" type="submit">--}}
{{--                            <i class="fas fa-file-pdf"></i>--}}
{{--                        </button>--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--            </form>--}}

{{--            <br/>--}}
{{--            <br/>--}}
            <div class="table-responsive">
                <form method="POST" name="frmtiposUsuario" action="{{ route('perfil.customUpdate', $idPermissao)}}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                <input type="hidden" name="perfil" value="{{$perfil}}">
                <table class="table">
                    <thead class="thead-hide">
                        <th>Menus</th>
                        <th>Visualizar</th>
                        <th>Adicionar</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                        <th>Relatório</th>
                    </thead>
                    <tbody>
                            @forelse($results as $key => $chaves)
                                @foreach ($chaves as $key2 => $permissoes)
                                    <tr>
                                        <td>{{ $key2 }}</td>
                                        @foreach ($permissoes as $p)
                                            <td>
                                                <input
                                                    @if($p->status == 0) disabled @endif
                                                    type="checkbox"
                                                    name="chaves_ordem[]"
                                                    id="optionsPermissao{{ $p->id }}"
                                                    value="{{ $p->id }}"
                                                    @if ($p->checarPermissaoTelaPerfil($p->id, $perfil->id, $perfil->setor_id))
                                                        checked
                                                    @endif
                                                    class="{{ $p->descricao  }}"
                                                    onclick="pegaNome(
                                                        '<?php echo substr($p->descricao, 0, strpos($p->descricao, ' ')); ?>',
                                                        '<?php echo substr($p->descricao, strpos($p->descricao, ' '), 11) ?>'
                                                    )"
                                                >
                                                <label for="optionsPermissao{{ $p->id }}" style="cursor: pointer;">
                                                    {{ $p->descricao }}
                                                </label>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @empty
                                <p class="p-1 hide-thead" onload="hideThead()">Nenhum Perfil encontrado</p>
                            @endforelse
                    </tbody>
                </table>
                <div class="form-group">
                    <a href="{{url('perfil')}}" title="Voltar" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
                    <input class="btn btn-primary" type="submit" value="Cadastar">
                </div>
                </form>
{{--                <div class="pagination-wrapper"> {!! $results->appends(['search' => Request::get('search')])->render() !!} </div>--}}
            </div>

        </div>
    </div>
@endsection
