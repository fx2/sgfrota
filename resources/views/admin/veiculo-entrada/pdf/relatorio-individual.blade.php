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
                @if($results->controle_frota_id)
                    <tr><td><strong class="text-leftzinho">Proprietário</strong>: {{ $results->controle_frota->nome_proprietario }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Marca</strong>: {{ $results->controle_frota->marca->nome }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Modelo</strong>: {{ $results->controle_frota->modelo->modelo }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Típo de combustível</strong>: {{ $results->controle_frota->tipo_combustivel->nome }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Cor</strong>: {{ $results->controle_frota->cor }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Capacidade</strong>: {{ $results->controle_frota->capacidade }} </td></tr>
                    <tr><td><strong class="text-leftzinho">Ano</strong>: {{ $results->controle_frota->ano_modelo }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Km inícial</strong>: {{ decimal($results->controle_frota->km_inicial) }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Placa</strong>: {{ $results->controle_frota->placa }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Renavan</strong>: {{ $results->controle_frota->renavan }}</td></tr>
                @else
                    <tr><td><strong class="text-leftzinho">Proprietário</strong>: {{ $results->veiculo_reserva_entrada->nome_proprietario }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Marca</strong>: {{ $results->veiculo_reserva_entrada->marca->nome }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Modelo</strong>: {{ $results->veiculo_reserva_entrada->modelo->modelo }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Típo de combustível</strong>: {{ $results->veiculo_reserva_entrada->tipo_combustivel->nome }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Cor</strong>: {{ $results->veiculo_reserva_entrada->cor }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Capacidade</strong>: {{ $results->veiculo_reserva_entrada->capacidade }} </td></tr>
                    <tr><td><strong class="text-leftzinho">Ano</strong>: {{ $results->veiculo_reserva_entrada->ano_modelo }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Km inícial</strong>: {{ decimal($results->veiculo_reserva_entrada->km_inicial) }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Placa</strong>: {{ $results->veiculo_reserva_entrada->placa }}</td></tr>
                    <tr><td><strong class="text-leftzinho">Renavan</strong>: {{ $results->veiculo_reserva_entrada->renavan }}</td></tr>
                @endif
                <tr><td><strong class="text-leftzinho">Responsável</strong>: {{ $results->veiculo_saida->nome_responsavel }}</td></tr>
                <tr><td><strong class="text-leftzinho">Setor</strong>: {{ $results->veiculo_saida->setor->nome }}</td></tr>
                <tr><td><strong class="text-leftzinho">Veículo reserva</strong>: 
                    @if ($results->veiculo_reserva_entrada_id)
                        Sim
                    @else
                        Não
                    @endif
                </td></tr>
            </table>
        </td>

        <td class="borda">
            <p style="width: 70px; left: 5px; position:relative;">
                <span style="margin-left: 5%;"><strong>Motorista</strong></span>
            </p>
            <table class="borda" style="margin-bottom: 0px; width:78%; left:40px; position:relative;">
                <tr><td><strong class="text-leftzinho">Proprietário</strong>: {{ $results->motorista->nome }} </td></tr>
                <tr><td><strong class="text-leftzinho">Típo CNH</strong>: {{ $results->motorista->tipoCnh->nome }}</td></tr>
                <tr><td><strong class="text-leftzinho">CNH</strong>: {{ $results->motorista->cnh }}</td></tr>
                <tr><td style="color:white;"><strong class="text-leftzinho">RG</strong>: {{ $results->motorista->rg }}</td></tr>
                <tr><td style="color:white;"><strong class="text-leftzinho">CPF</strong>: {{ $results->motorista->cpf }} </td></tr>
                                <tr><td><strong class="text-leftzinho" style="color:white;">a</strong> </td></tr>
                                <tr><td><strong class="text-leftzinho" style="color:white;">a</strong> </td></tr>

            </table>


            <table class="borda" style="width:85%; left:30px; position:relative;">
                <tr>
                    @if($results->controle_frota_id)
                        <td><strong class="text-leftzinho">Responsável</strong>: {{ isset($results->controle_frota->responsavel) ? $results->controle_frota->responsavel->nome : '' }}</td>
                    @else
                        <td><strong class="text-leftzinho">Responsável</strong>: {{ $results->veiculo_reserva_entrada->responsavel->nome }}</td>
                    @endif
                </tr>
                <tr>
                    <td><span class="text-leftzinho" style="color:white;">a</span> </td>
                </tr>
            </table>

            <table class="borda" style="width:85%; left:30px; position:relative;">
                <tr>
                    <td><strong class="text-leftzinho">Data da Saída</strong>: {{ convertTimestamp($results->veiculo_saida->saida_data, 'd/m/Y') }}</td>
                </tr>
                <tr>
                    <td><span class="text-leftzinho" style="color:white;">a</span> </td>
                </tr>
            </table>

            <table class="borda" style="width:85%; left:30px; position:relative;">
                <tr>
                    <td><strong class="text-leftzinho">Hora da Saída</strong>: {{convertTimestamp($results->veiculo_saida->saida_hora, 'H:i')}}</td>
                </tr>
                <tr>
                    <td><span class="text-leftzinho" style="color:white;">a</span> </td>
                </tr>
            </table>
        </td>

    </tr>
</table>

<table class="table borda" style="margin-top: 3px;">
    <tr>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>KM SAIDA</strong>: {{ decimal($results->veiculo_saida->km_inicial) }} </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Qtd. Combustível</strong>: {{ $results->veiculo_saida->quantidade_combustivel }}</p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Usuário SAIDA</strong>: {{ $results->veiculo_saida->userAuth->name }} </p></td>
    </tr>
</table>

<table class="table borda" style="margin-top: 3px;">
    <tr>
        <td class="borda">
            <table class="table" style="width: 90%; margin-left: 10px;">
                <tr>
                    <td width="100%">
                        <table width="100%">
                            <tr>
                                <td><strong>Mecânica</strong></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" name="title" @if($results->mecanica == 1) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Bom</span></td>

                                            <td>
                                                <input type="radio" name="title" @if($results->mecanica == 0) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Ruim</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Eletríca</strong></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" name="title" @if($results->eletrica == 1) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Bom</span></td>

                                            <td>
                                                <input type="radio" name="title" @if($results->eletrica == 0) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Ruim</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Funilaria</strong></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" name="title" @if($results->funilaria == 1) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Bom</span></td>

                                            <td>
                                                <input type="radio" name="title" @if($results->funilaria == 0) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Ruim</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Pintura</strong></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" name="title" @if($results->pintura == 1) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Bom</span></td>

                                            <td>
                                                <input type="radio" name="title" @if($results->pintura == 0) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Ruim</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Pneus</strong></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" name="title" @if($results->pneus == 1) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Bom</span></td>

                                            <td>
                                                <input type="radio" name="title" @if($results->pneus == 0) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Ruim</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>

        <td class="borda">
            <table class="table" style="width: 90%; margin-left: 10px;">
                <tr>
                    <td width="100%">
                        <table width="100%">
                            <tr>
                                <td><strong>Macaco</strong></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" name="title" @if($results->macaco == 1) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Sim</span></td>

                                            <td>
                                                <input type="radio" name="title" @if($results->macaco == 0) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Não</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Triangulo</strong></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" name="title" @if($results->triangulo == 1) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Sim</span></td>

                                            <td>
                                                <input type="radio" name="title" @if($results->triangulo == 0) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Não</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Estepe</strong></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" name="title" @if($results->estepe == 1) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Sim</span></td>

                                            <td>
                                                <input type="radio" name="title" @if($results->estepe == 0) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Não</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Extintor</strong></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" name="title" @if($results->extintor == 1) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Sim</span></td>

                                            <td>
                                                <input type="radio" name="title" @if($results->extintor == 0) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Não</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Chave Roda</strong></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" name="title" @if($results->chave_roda == 1) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Sim</span></td>

                                            <td>
                                                <input type="radio" name="title" @if($results->chave_roda == 0) checked @endif>
                                            </td>
                                            <td><span style="margin-left: 10px;">Não</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
            </table>
        </td>
    </tr>
</table>

<table class="table borda">
    <tr>
        <td class="borda" width="100%"><p class="text-leftzinho" style="font-size: 13px;"><strong>Observação</strong>: {{ $results->veiculo_saida->observacao_situacao }}</p></td>
        <td class="borda" width="100%"><p class="text-leftzinho" style="font-size: 13px;"><strong>Observação</strong>: {{ $results->veiculo_saida->observacao_acessorio }} </p></td>
    </tr>
</table>

<table class="table borda" style="margin-top: 3px;">
    <tr>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Data Entrada</strong>: {{ convertTimestamp($results->entrada_data, 'd/m/Y') }} </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Horário Entrada</strong>: {{ convertTimestamp($results->entrada_hora, 'H:i') }} </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Km Entrada</strong>: {{ decimal($results->km_final) }} </p></td>
    </tr>
</table>

<table class="table borda" style="margin-top: 3px;">
    <tr>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Qtd. Combustível</strong>: {{ $results->quantidade_combustivel }} </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Usuário ENTRADA</strong>: {{ $results->userAuth->name  }} </p></td>
    </tr>
</table>

<table class="table borda" style="margin-top: 3px;">
    <tr>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Relatório do Trajeto</strong>: {{ $results->relatorio_trajeto_motorista }} </p></td>
    </tr>
</table>

<table class="table borda" style="margin-top: 3px;">
    <tr>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Observação</strong>: {{ $results->observacao }} </p></td>
    </tr>
</table>

@endsection
