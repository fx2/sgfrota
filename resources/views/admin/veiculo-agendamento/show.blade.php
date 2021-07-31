@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('veiculo-agendamento') }}">Veículo Agendamento</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar Veículo Agendamento</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">Veículo Agendamento </div>
        <div class="card-body">

            <a href="{{ url('/veiculo-agendamento') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            <a href="{{ url('/veiculo-agendamento/' . $result->id . '/edit') }}" title="Edit VeiculoAgendamento"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('veiculoagendamento' . '/' . $result->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete VeiculoAgendamento" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $result->id }}</td>
                        </tr>
                        <tr><th> Controle Frota Id </th><td> {{ $veiculoagendamento->controle_frota_id }} </td></tr><tr><th> Departamento </th><td> {{ $veiculoagendamento->departamento }} </td></tr><tr><th> Periodo </th><td> {{ $veiculoagendamento->periodo }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
