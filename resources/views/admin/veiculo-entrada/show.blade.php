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
            <br />
            <br />

            @if ($errors->any())
                <p class="alert alert-danger">Ops, algo deu errado... confira os campos e tente novamente.</p>
            @endif

            <form method="POST" action="{{ url('/veiculo-entrada/' . $result->id) }}" id="form1" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                @include ('admin.veiculo-entrada.form', ['formMode' => 'show'])

            </form>

        </div>
    </div>
@endsection

@push('js')
    <script>
        $("#form1 :input").attr("disabled", true);
    </script>
@endpush
