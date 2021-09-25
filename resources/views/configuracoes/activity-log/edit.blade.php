@extends('layouts.admin.index')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('activity-log') }}">Log de atividades</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Log de atividades</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">Log de atividades </div>
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
                    @isset($properties['old']) <th>Original</th> @endisset
                    <th>Novo</th>
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
                                    {{ convertTimestamp($properties['old'][$key]) }}
                                @elseif ($key == 'saida_data')
                                    {{ convertTimestamp($properties['old'][$key], 'd/m/Y') }}
                                @elseif ($key == 'saida_hora')
                                    {{ convertTimestamp($properties['old'][$key], 'H:i') }}
                                @elseif ($key == 'data')
                                    {{ convertTimestamp($properties['old'][$key], 'd/m/Y') }}
                                @elseif ($key == 'hora')
                                    {{ convertTimestamp($properties['old'][$key], 'H:i') }}

                                @elseif ($key == 'entrada_data')
                                    {{ convertTimestamp($properties['old'][$key], 'd/m/Y') }}
                                @elseif ($key == 'entrada_hora')
                                    {{ convertTimestamp($properties['old'][$key], 'H:i') }}

                                @elseif ($key == 'controle_frota_id')
                                    {{ \App\Models\ControleFrotum::find($properties['old'][$key])['veiculo'] }}
                                @elseif ($key == 'motorista_id')
                                    {{ \App\Models\Motoristum::find($properties['old'][$key])['nome'] }}
                                @elseif ($key == 'setor_id')
                                    {{ \App\Models\Setor::find($properties['old'][$key])['nome'] }}
                                @elseif ($key == 'auth_id')
                                    @if ($properties['old'][$key])
                                        {{ \App\Models\User::find($properties['old'][$key])['name'] }}
                                    @endif
                                @elseif ($key == 'mecanica')
                                    {{ $properties['old'][$key] == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'eletrica')
                                    {{ $properties['old'][$key] == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'funilaria')
                                    {{ $properties['old'][$key] == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'pintura')
                                    {{ $properties['old'][$key] == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'pneus')
                                    {{ $properties['old'][$key] == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'pneu')
                                    {{ $properties['old'][$key] == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'macaco')
                                    {{ $properties['old'][$key] == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'triangulo')
                                    {{ $properties['old'][$key] == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'estepe')
                                    {{ $properties['old'][$key] == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'extintor')
                                    {{ $properties['old'][$key] == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'chave_roda')
                                    {{ $properties['old'][$key] == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'status')
                                    {{ $properties['old'][$key] == 1 ? 'ATIVO' : 'BLOQUEADO' }}
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
                            {{-- datas--}}
                            @if ($key == 'created_at' OR $key == 'updated_at')
                                    {{ convertTimestamp($value) }}
                                @elseif ($key == 'saida_data')
                                    {{ convertTimestamp($value, 'd/m/Y') }}
                                @elseif ($key == 'saida_hora')
                                    {{ convertTimestamp($value, 'H:i') }}
                                @elseif ($key == 'data')
                                    {{ convertTimestamp($value, 'd/m/Y') }}
                                @elseif ($key == 'hora')
                                    {{ convertTimestamp($value, 'H:i') }}
                                @elseif ($key == 'entrada_data')
                                    {{ convertTimestamp($value, 'd/m/Y') }}
                                @elseif ($key == 'entrada_hora')
                                    {{ convertTimestamp($value, 'H:i') }}
                                @elseif ($key == 'data_multa')
                                    {{ convertTimestamp($value, 'd/m/Y') }}
                                @elseif ($key == 'hora_multa')
                                    {{ convertTimestamp($value, 'H:i') }}

                                {{-- joins --}}
                                @elseif ($key == 'controle_frota_id')
                                    {{ \App\Models\ControleFrotum::find($value)['veiculo'] }}
                                @elseif ($key == 'motorista_id')
                                    {{ \App\Models\Motoristum::find($value)['nome'] }}
                                @elseif ($key == 'setor_id')
                                    {{ \App\Models\Setor::find($value)['nome'] }}
                                @elseif ($key == 'auth_id')
                                    {{ \App\Models\User::find($value)['name'] }}
                                @elseif ($key == 'tipo_manutencao_id')
                                    {{ \App\Models\TipoManutencao::find($value)['nome'] }}
                                @elseif ($key == 'fornecedor_id')
                                    {{ \App\Models\Fornecedor::find($value)['razao_social'] }}
                                @elseif ($key == 'tipo_correcao_id')
                                    {{ \App\Models\TipoCorrecao::find($value)['nome'] }}
                                @elseif ($key == 'tipo_multa_id')
                                    {{ \App\Models\TipoCorrecao::find($value)['nome'] }}
                                @elseif ($key == 'tipo_combustivel_id')
                                    {{ \App\Models\TipoCombustivel::find($value)['nome'] }}
                                @elseif ($key == 'estado_id')
                                    {{ \App\Models\Country::find($value)['nome_pt'] }}
                                @elseif ($key == 'municipio_id')
                                    {{ \App\Models\State::find($value)['nome'] }}

                                @elseif ($key == 'tipo_veiculo')
                                    {{ \App\Models\TipoVeiculo::find($value)['nome'] }}
                                @elseif ($key == 'tipo_responsavel')
                                    {{ \App\Models\TipoResponsavel::find($value)['nome'] }}

                                {{--SIM NAO--}}
                                @elseif ($key == 'mecanica')
                                    {{ $value == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'eletrica')
                                    {{ $value == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'funilaria')
                                    {{ $value == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'pintura')
                                    {{ $value == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'pneus')
                                    {{ $value == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'pneu')
                                    {{ $value == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'macaco')
                                    {{ $value == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'triangulo')
                                    {{ $value == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'estepe')
                                    {{ $value == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'extintor')
                                    {{ $value == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'chave_roda')
                                    {{ $value == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'pago')
                                    {{ $value == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'disponivel_outros_departamentos')
                                    {{ $value == 1 ? 'SIM' : 'NÃO' }}
                                @elseif ($key == 'status')
                                    {{ $value == 1 ? 'ATIVO' : 'BLOQUEADO' }}


                                {{--IMAGENS--}}
                                @elseif ($key == 'foto_multa')
                                    <img width="100%" height="400px" src="{{ isset($value) ? removePublicPath(asset($value)) : '' }}" alt="">
                                @elseif ($key == 'foto')
                                    <img src="{{ isset($value) ? removePublicPath(asset($value)) : '' }}" alt="">
                                @elseif ($key == 'dut')
                                    <img src="{{ isset($value) ? removePublicPath(asset($value)) : $value }}" alt="">
                                {{$value}}
                                @else
                                    {{ $value }}
                                @endif
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
@endsection
