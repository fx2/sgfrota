@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('controle-frota') }}">Controle de Frota</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar Controle de Frota</li>
        </ol>
    </nav> 
    <div class="card">
        <div class="card-header">Controle de Frota </div>
        <div class="card-body">

            <a href="{{ url('/controle-frota') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            <a href="{{ url('/controle-frota/' . $result->id . '/edit') }}" title="Edit Controle de Frota"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('controlefrota' . '/' . $result->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Controle de Frota" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $result->id }}</td>
                        </tr>
                        <tr><th> Tipo Veiculo </th><td> {{ $controlefrotum->tipo_veiculo }} </td></tr><tr><th> Nome Proprietario </th><td> {{ $controlefrotum->nome_proprietario }} </td></tr><tr><th> Disponivel Outros Departamentos </th><td> {{ $controlefrotum->disponivel_outros_departamentos }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
