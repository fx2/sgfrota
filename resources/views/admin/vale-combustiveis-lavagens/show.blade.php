@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('vale-combustiveis-lavagens') }}">Vale combustíveis e lavagens</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar Vale combustíveis e lavagens</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">Vale Combustíveis e Lavagen </div>
        <div class="card-body">

            <a href="{{ url('/vale-combustiveis-lavagens') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            <a href="{{ url('/vale-combustiveis-lavagens/' . $result->id . '/edit') }}" title="Edit Vale combustíveis e Lavagen"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('valecombustiveislavagens' . '/' . $result->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Vale combustíveis e Lavagen" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $result->id }}</td>
                        </tr>
                        <tr><th> Controle Frota Id </th><td> {{ $valecombustiveislavagen->controle_frota_id }} </td></tr><tr><th> Quantidade Litros </th><td> {{ $valecombustiveislavagen->quantidade_litros }} </td></tr><tr><th> Tipo Combustivel Id </th><td> {{ $valecombustiveislavagen->tipo_combustivel_id }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
