@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('solicitacoes') }}">Solicitacões</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrar Solicitacões</li>
        </ol>
    </nav> 

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="">Cadastrar Solicitacões</div>
                <div class="">Data: {{ convertTimestamp($data, 'd/m/Y') }}</div>
                <div class="">Hora: {{ $horario }}</div>
                <div class="">Sequencial/Ano: <strong>{{ $sequencial }}</strong></div>
            </div>
        </div>
        <div class="card-body">
            <a href="{{ url('/solicitacoes') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            <br />
            <br />

            @if ($errors->any())
                <p class="alert alert-danger">Ops, algo deu errado... confira os campos e tente novamente.</p>
            @endif

            <form method="POST" action="{{ url('/solicitacoes') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}

                @include ('admin.solicitacoes.form', ['formMode' => 'create'])

              <input type="hidden" name="sequencia" value="{{ $sequencial }}">
              <input type="hidden" name="data" value="{{ $data }}">
              <input type="hidden" name="horario" value="{{ $horario }}">
            </form>

        </div>
    </div>
@endsection
