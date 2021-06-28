@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('motorista') }}">Motorista</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar Motorista</li>
        </ol>
    </nav> 
    <div class="card">
        <div class="card-header">Motorista </div>
        <div class="card-body">

            <a href="{{ url('/motorista') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            <a href="{{ url('/motorista/' . $result->id . '/edit') }}" title="Edit Motoristum"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('motorista' . '/' . $result->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Motoristum" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $result->id }}</td>
                        </tr>
                        <tr><th> Motorista Escolar </th><td> {{ $motoristum->motorista_escolar }} </td></tr><tr><th> Tipo Motorista </th><td> {{ $motoristum->tipo_motorista }} </td></tr><tr><th> Certificado Transporte Escolar </th><td> {{ $motoristum->certificado_transporte_escolar }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
