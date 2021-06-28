@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('abastecimento') }}">Abastecimento</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar Abastecimento</li>
        </ol>
    </nav> 
    <div class="card">
        <div class="card-header">Abastecimento </div>
        <div class="card-body">

            <a href="{{ url('/abastecimento') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            <a href="{{ url('/abastecimento/' . $result->id . '/edit') }}" title="Edit Abastecimento"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('abastecimento' . '/' . $result->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Abastecimento" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $result->id }}</td>
                        </tr>
                        <tr><th> Modelo Id </th><td> {{ $abastecimento->modelo_id }} </td></tr><tr><th> Tipo Combustivel Id </th><td> {{ $abastecimento->tipo_combustivel_id }} </td></tr><tr><th> Fornecedor Id </th><td> {{ $abastecimento->fornecedor_id }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
