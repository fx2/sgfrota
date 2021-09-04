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
            <p style="width:70px; left: 5px; position:relative;">
                <span style="margin-left: 5%;"><strong>Veículo</strong></span>
            </p>
            <table class="borda" style="margin-bottom: 15px; width:78%; left:40px; position:relative;">

                <tr><td><strong class="text-leftzinho">Proprietário</strong>: {{ $results->nome_proprietario }}</td></tr>
                <tr><td><strong class="text-leftzinho">Marca</strong>: {{ $results->marca->nome }}</td></tr>
                <tr><td><strong class="text-leftzinho">Modelo</strong>: {{ $results->modelo->modelo }}</td></tr>
                <tr><td><strong class="text-leftzinho">Típo de combustível</strong>: {{ $results->tipo_combustivel->nome }}</td></tr>
                <tr><td><strong class="text-leftzinho">Cor</strong>: {{ $results->cor }}</td></tr>
                <tr><td><strong class="text-leftzinho">Capacidade</strong>: {{ $results->capacidade }} </td></tr>
                <tr><td><strong class="text-leftzinho">Ano</strong>: {{ $results->ano_modelo }}</td></tr>
                <tr><td><strong class="text-leftzinho">Km inícial</strong>: {{ decimal($results->km_inicial) }}</td></tr>
                <tr><td><strong class="text-leftzinho">Placa</strong>: {{ $results->placa }}</td></tr>
                <tr><td><strong class="text-leftzinho">Renavan</strong>: {{ $results->renavan }}</td></tr>

                <tr><td><strong class="text-leftzinho">Responsável</strong>: {{ $results->responsavel->nome }}</td></tr>
                <tr><td><strong class="text-leftzinho">Setor</strong>: {{ $results->setor->nome }}</td></tr>
            </table>
        </td>

        <td class="borda">
            <p style="width: 70px; left: 5px; position:relative;">
                <span style="margin-left: 5%;"><strong>Entrada</strong></span>
            </p>

            <table class="borda" style="width:85%; left:30px; position:relative;">
                <tr>
                        <td><strong class="text-leftzinho">Recebido por</strong>: {{ $results->entrada_recebido_por }}</td>

                </tr>
                <tr>
                    <td><span class="text-leftzinho" style="color:white;">a</span> </td>
                </tr>
            </table>

            <table class="borda" style="width:85%; left:30px; position:relative;">
                <tr>
                        <td><strong class="text-leftzinho">Data</strong>: {{ convertTimestamp($results->entrada_data, 'd/m/Y') }}</td>

                </tr>
                <tr>
                    <td><span class="text-leftzinho" style="color:white;">a</span> </td>
                </tr>
            </table>
            <table class="borda" style="width:85%; left:30px; position:relative;">
                <tr>
                        <td><strong class="text-leftzinho">Horario</strong>: {{ convertTimestamp($results->entrada_horario, 'H:i') }}</td>

                </tr>
                <tr>
                    <td><span class="text-leftzinho" style="color:white;">a</span> </td>
                </tr>
            </table>

            <table class="borda" style="width:85%; left:30px; position:relative;">
                <tr>
                    <td><strong class="text-leftzinho">Combustível</strong>: {{ $results->entrada_combustivel }}</td>
                </tr>
                <tr>
                    <td><span class="text-leftzinho" style="color:white;">a</span> </td>
                </tr>
            </table>

            <table class="borda" style="width:85%; left:30px; position:relative;">
                <tr>
                    <td style="color: white;"><strong class="text-leftzinho">Combustível</strong>: {{ $results->entrada_combustivel }}</td>
                </tr>
                <tr>
                    <td><span class="text-leftzinho" style="color:white;">a</span> </td>
                </tr>
            </table>

            <table class="borda" style="width:85%; left:30px; position:relative;">
                <tr>
                    <td style="color: white;"><strong class="text-leftzinho">Combustível</strong>: {{ $results->entrada_combustivel }}</td>
                </tr>
                <tr>
                    <td><span class="text-leftzinho" style="color:white;">a</span> </td>
                </tr>
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

@endsection
