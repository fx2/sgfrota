@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('activity-log') }}">Log de Atividades  </a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">Log de Atividades do {{ $user->name  }} do Setor: {{ $user->setor->nome }}</div>
        <div class="card-body">

            <table id="datatable-buttons" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ação</th>
                                    <th>Onde</th>
{{--                                    <th>Quem</th>--}}
                                    <th>Data</th>
                                    <th>Ferramentas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logactivitys as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($item->description == 'cadastro') CADASTROU @endif
                                            @if ($item->description == 'edição') EDITOU @endif
{{--                                            @if ($item->description == 'visualized') VISUALIZOU @endif--}}
                                            @if ($item->description == 'deletou') DELETOU @endif
                                        </td>
                                        <td>
                                            {{ strtoupper($item->subject_type) }}
                                        </td>
{{--                                        <td>--}}
{{--                                            @php $properties = json_decode($item->properties); @endphp--}}
{{--                                            @isset($properties->old->auth_id)--}}
{{--                                                {{ \App\Models\User::find($properties->old->auth_id)['name'] }}--}}
{{--                                            @endisset--}}
{{--                                        </td>--}}

                                        <td>{{ convertTimestamp($item->created_at) }}</td>

                                        <td>
                                            <a href="{{ url('/activity-log/' . $item->id . '/edit') }}" title="Editar Log de atividades"><button class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i> Visualizar</button></a>

                                            <!--
                                                <form method="POST" action="{{ url('/admin/configuracoes/log-activity' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Deletar Log de atividades" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Deletar</button>
                                                </form>
                                            -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                <div class="pagination-wrapper"> {!! $logactivitys->appends(['search' => Request::get('search')])->render() !!} </div>

        </div>
    </div>
@endsection

@push('js')
    <script>
        $("#form1 :input").attr("disabled", true);
    </script>
@endpush
