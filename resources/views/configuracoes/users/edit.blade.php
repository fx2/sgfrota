@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('users') }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Users</li>
        </ol>
    </nav> 

    <div class="card">
        <div class="card-header">Editar User </div>
        <div class="card-body">
            <a href="{{ url('/users') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            <br />
            <br />

            @if ($errors->any())
                <p class="alert alert-danger">Ops, algo deu errado... confira os campos e tente novamente.</p>
            @endif

            <form method="POST" action="{{ url('/users/' . $result->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                @include ('configuracoes.users.form', ['formMode' => 'edit'])

            </form>

        </div>
    </div>
@endsection
