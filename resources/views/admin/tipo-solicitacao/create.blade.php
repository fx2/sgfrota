@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('tipo-solicitacao') }}">Tipo de Solicitacão</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrar Tipo de Solicitacão</li>
        </ol>
    </nav> 

    <div class="card">
        <div class="card-header">Cadastrar Tipo de Solicitacão</div>
        <div class="card-body">
            <a href="{{ url('/tipo-solicitacao') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            <br />
            <br />

            @if ($errors->any())
                <p class="alert alert-danger">Ops, algo deu errado... confira os campos e tente novamente.</p>
            @endif

            <form method="POST" action="{{ url('/tipo-solicitacao') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}

                @include ('admin.tipo-solicitacao.form', ['formMode' => 'create'])

            </form>

        </div>
    </div>
@endsection
