@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('user') }}">Usuário</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar Usuário</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">Usuário</div>
        <div class="card-body">

            <a href="{{ url('/user') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            <a href="{{ url('/user/' . $result->id . '/edit') }}" title="Edit Usuário"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('tipomultas' . '/' . $result->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Usuário" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $result->id }}</td>
                        </tr>
                        <tr><th> Tipo </th><td> {{ $tipomulta->tipo }} </td></tr><tr><th> Descricao </th><td> {{ $tipomulta->descricao }} </td></tr><tr><th> Pontuacao </th><td> {{ $tipomulta->pontuacao }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
