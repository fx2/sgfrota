@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('manutencao') }}">Manutenção/Despesas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar Manutenção/Despesas</li>
        </ol>
    </nav> 
    <div class="card">
        <div class="card-header">Manutenção/Despesas </div>
        <div class="card-body">

            <a href="{{ url('/manutencao') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            <a href="{{ url('/manutencao/' . $result->id . '/edit') }}" title="Edit Manutenção/Despesas"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('lancamentomultas' . '/' . $result->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Manutenção/Despesas" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $result->id }}</td>
                        </tr>
                        <tr><th> Modelo Id </th><td> {{ $lancamentomulta->modelo_id }} </td></tr><tr><th> Tipo Manutencao Id </th><td> {{ $lancamentomulta->tipo_manutencao_id }} </td></tr><tr><th> Fornecedor Id </th><td> {{ $lancamentomulta->fornecedor_id }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
