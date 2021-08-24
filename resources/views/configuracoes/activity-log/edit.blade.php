@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('activity-log') }}">Activitylog</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Activitylog</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">Editar ActivityLog </div>
        <div class="card-body">
            <a href="{{ url('/activity-log') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            <br />
            <br />

            @if ($errors->any())
                <p class="alert alert-danger">Ops, algo deu errado... confira os campos e tente novamente.</p>
            @endif

            <table class="table table-bordered">
                <tr>
                    <th>Campos</th>
                    @isset($properties['old']) <th>Old</th> @endisset
                    <th>New</th>
                </tr>
                @foreach ($properties['attributes'] as $key => $value)
                    @if($key == '_method' || $key == '_token')
                        @continue
                    @endif
                    <tr>
                        <th>{{ $key }}</th>

                        @isset($properties['old'])
                            <td>
                                @if ($key == 'created_at' OR $key == 'updated_at')
                                    {{ \App\Utils::formatDateTimeToView($properties['old'][$key]) }}
                                @else
                                    {{ $properties['old'][$key] }}
                                @endif
                            </td>
                        @endisset

                        <td
                            @isset($properties['old'])
                                @if($properties['old'][$key] != $properties['attributes'][$key])
                                    style="background-color: lightblue;"
                                @endif
                            @endisset
                        >
                            @if (
                                    $key == 'created_at'
                                    OR $key == 'updated_at'
                                )
                                {{ convertTimestamp($value) }}
                            @endif
                                {{ $value }}
                        </td>
                    </tr>
                @endforeach
            </table>


        </div>
    </div>
@endsection
