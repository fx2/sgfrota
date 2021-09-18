@extends('layouts.pdf.pdf-padrao')

@section('content-title')
{{$pdfTitle}}
@endsection
@section('content-title-2')
{{--NOS TERMOS DO ANEXO I – ATO DA MESA Nº 635/2020 e 636/2020--}}
@endsection

@section('content')
<table class="table borda">
    <tr>
        <td class="borda">
            <p style="width:100px; left: 5px; position:relative;">
                <span style="margin-left: 5%;"><strong>Veículo reserva</strong></span>
            </p>
            <table class="borda" style="margin-bottom: 35px; width:78%; left:40px; position:relative;">

                <tr><td><strong class="text-leftzinho">Proprietário</strong>: {{ $results->nome_proprietario }}</td></tr>
                <tr><td><strong class="text-leftzinho">Marca</strong>: {{ $results->marca->nome }}</td></tr>
                <tr><td><strong class="text-leftzinho">Modelo</strong>: {{ $results->modelo->modelo }}</td></tr>
                <tr><td><strong class="text-leftzinho">Típo de combustível</strong>: {{ $results->tipo_combustivel->nome }}</td></tr>
                <tr><td><strong class="text-leftzinho">Cor</strong>: {{ $results->cor }}</td></tr>
                <tr><td><strong class="text-leftzinho">Capacidade</strong>: {{ $results->capacidade }} </td></tr>
                <tr><td><strong class="text-leftzinho">Ano</strong>: {{ $results->ano_modelo }}</td></tr>
                <tr><td><strong class="text-leftzinho">Km atual</strong>: {{ decimal($results->km_atual) }}</td></tr>
                <tr><td><strong class="text-leftzinho">Placa</strong>: {{ $results->placa }}</td></tr>
                <tr><td><strong class="text-leftzinho">Renavan</strong>: {{ $results->renavan }}</td></tr>
                
                <tr><td><strong class="text-leftzinho"></strong></td></tr>
                <tr><td><strong class="text-leftzinho"></strong></td></tr>
                <tr><td><strong class="text-leftzinho"></strong></td></tr>
                <tr><td><strong class="text-leftzinho"></strong></td></tr>
                <tr><td><strong class="text-leftzinho"></strong></td></tr>
                <tr><td><strong class="text-leftzinho"></strong></td></tr>

                {{-- <tr><td><strong class="text-leftzinho">Responsável</strong>: {{ $results->responsavel->nome }}</td></tr>
                <tr><td><strong class="text-leftzinho">Setor</strong>: {{ $results->setor->nome }}</td></tr> --}}
            </table>
        </td>

        <td class="borda">
            <p style="width: 110px; left: 5px; position:relative; margin-bottom: 15px;">
                <span style="margin-left: 5%;"><strong>Veículo para reparo</strong></span>
            </p>

            <table class="borda" style="margin-bottom: 15px; width:78%; left:40px; position:relative;">
                <tr><td><strong class="text-leftzinho">Proprietário</strong>: {{ $results->controle_frota->nome_proprietario }}</td></tr>
                <tr><td><strong class="text-leftzinho">Marca</strong>: {{ $results->controle_frota->marca->nome }}</td></tr>
                <tr><td><strong class="text-leftzinho">Modelo</strong>: {{ $results->controle_frota->modelo->modelo }}</td></tr>
                <tr><td><strong class="text-leftzinho">Típo de combustível</strong>: {{ $results->controle_frota->tipo_combustivel->nome }}</td></tr>
                <tr><td><strong class="text-leftzinho">Cor</strong>: {{ $results->controle_frota->cor }}</td></tr>
                <tr><td><strong class="text-leftzinho">Capacidade</strong>: {{ $results->controle_frota->capacidade }} </td></tr>
                <tr><td><strong class="text-leftzinho">Ano</strong>: {{ $results->controle_frota->ano_modelo }}</td></tr>
                <tr><td><strong class="text-leftzinho">Km atual</strong>: {{ decimal($results->controle_frota->km_atual) }}</td></tr>
                <tr><td><strong class="text-leftzinho">Placa</strong>: {{ $results->controle_frota->placa }}</td></tr>
                <tr><td><strong class="text-leftzinho">Renavan</strong>: {{ $results->controle_frota->renavan }}</td></tr>

                <tr><td><strong class="text-leftzinho">Responsável</strong>: {{ $results->controle_frota->responsavel->nome }}</td></tr>
                <tr><td><strong class="text-leftzinho">Setor</strong>: {{ $results->controle_frota->setor->nome }}</td></tr>
            </table>
        </td>

    </tr>
</table>

<table class="table borda" style="margin-top: 8px;">
    <tr>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Entrada Forma Substituicao</strong>: {{ $results->entrada_forma_substituicao }} </p></td>
    </tr>
</table>

<table class="table borda" style="margin-top: 8px;">
    <tr>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Entrada Observação</strong>: {{ $results->entrada_observacao }} </p></td>
    </tr>
</table>

<table class="table borda" style="margin-top: 8px;">
    <tr>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Recebido por</strong>: {{ $results->entrada_recebido_por }} </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Data</strong>: {{ convertTimestamp($results->entrada_data, 'd/m/Y') }} </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Horário</strong>: {{ convertTimestamp($results->entrada_horario, 'H:i') }} </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Visual combustivel</strong>: {{ $results->entrada_combustivel }} </p></td>
    </tr>
</table>

    <h4 class="text-center">Dados do retorno do veículo</h4>


<table class="table borda" style="margin-top: 8px;">
    <tr>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Recebido por</strong>: {{ $results->devolucao_recebido_por }} </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Data</strong>: {{ convertTimestamp($results->devolucao_data, 'd/m/Y') }} </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Horário</strong>: {{ convertTimestamp($results->devolucao_horario, 'H:i') }} </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Visual combustivel</strong>: {{ $results->devolucao_combustivel }} </p></td>
    </tr>
</table>


<table class="table borda" style="margin-top: 8px;">
    <tr>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Observação</strong>: {{ $results->devolucao_observacao }} </p></td>
    </tr>
</table>

<table class="table borda" style="margin-top: 8px;">
    <tr>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Usuário da entrada</strong>: {{ $results->auth->name }} </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Usuário da devolução</strong>: {{ $results->devolucaoAuth->name }} </p></td>
    </tr>
</table>

@endsection
