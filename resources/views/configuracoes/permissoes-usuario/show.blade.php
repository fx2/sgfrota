@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('permissoes-usuario') }}">Permissoesusuario</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar Permissoesusuario</li>
        </ol>
    </nav> 
    <div class="card">
        <div class="card-header">PermissoesUsuario </div>
        <div class="card-body">

            <a href="{{ url('/permissoes-usuario') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            <a href="{{ url('/permissoes-usuario/' . $result->id . '/edit') }}" title="Edit PermissoesUsuario"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('permissoesusuario' . '/' . $result->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete PermissoesUsuario" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $result->id }}</td>
                        </tr>
                        <tr><th> Setor Id </th><td> {{ $permissoesusuario->setor_id }} </td></tr><tr><th> Idpermissao </th><td> {{ $permissoesusuario->idpermissao }} </td></tr><tr><th> Tipo Usuario </th><td> {{ $permissoesusuario->tipo_usuario }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
