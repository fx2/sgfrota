@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('veiculo-saida') }}">Controle diário de saída</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrar Controle diário de saída</li>
        </ol>
    </nav> 

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="">Cadastrar Controle diário de saída</div>
                <div class="">Sequencial/Ano: <strong>{{ $sequencial }}</strong></div>
                {{-- <div class="">Data da Saída: <strong>{{ date('d/m/Y') }}</strong></div>
                <div class="">Hora da Saída: <strong>{{ date('H:m') }}</strong></div> --}}
            </div>
        </div>
        <div class="card-body">
            <a href="{{ url('/veiculo-saida') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            <br />
            <br />

            @if ($errors->any())
                <p class="alert alert-danger">Ops, algo deu errado... confira os campos e tente novamente.</p>
            @endif

            <form method="POST" action="{{ url('/veiculo-saida') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}

                @include ('admin.veiculo-saida.form', ['formMode' => 'create'])

            </form>

        </div>
    </div>
@endsection
