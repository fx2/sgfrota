@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('veiculo-entrada') }}">Controle Diário de Entrada</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar Controle Diário de Entrada</li>
        </ol>
    </nav> 
    <div class="card">
        <div class="card-header">Controle Diário de Entrada </div>
        <div class="card-body">

            <a href="{{ url('/veiculo-entrada') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            <a href="{{ url('/veiculo-entrada/' . $result->id . '/edit') }}" title="Edit Controle Diário de Entrada"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('veiculoentrada' . '/' . $result->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Controle Diário de Entrada" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $result->id }}</td>
                        </tr>
                        <tr><th> Controle Frota Id </th><td> {{ $veiculoentrada->controle_frota_id }} </td></tr><tr><th> Km Final </th><td> {{ $veiculoentrada->km_final }} </td></tr><tr><th> Relatorio Trajeto Motorista </th><td> {{ $veiculoentrada->relatorio_trajeto_motorista }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
