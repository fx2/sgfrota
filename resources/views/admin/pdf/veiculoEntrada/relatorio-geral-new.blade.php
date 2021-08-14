@extends('layouts.pdf.pdf-padrao')

@section('content-title')
{{$pdfTitle}}
@endsection
@section('content-title-2')
NOS TERMOS DO ANEXO I – ATO DA MESA Nº 635/2020 e 636/2020
@endsection

@section('content')
<table class="table borda">
    <tr>
        <td class="borda">
            <p style="width:70px; left: 5px; position:relative;">
                <span style="margin-left: 5%;">Veículo</span>
            </p>
            <table class="borda" style="margin-bottom: 15px; width:78%; left:40px; position:relative;">
                <tr><td><strong class="text-leftzinho">Proprietário</strong>: Fjmx Sistemas</td></tr>
                <tr><td><strong class="text-leftzinho">Marca</strong>: Volks</td></tr>
                <tr><td><strong class="text-leftzinho">Modelo</strong>: Gol top rebaxadao</td></tr>
                <tr><td><strong class="text-leftzinho">Típo de combustível</strong>: Flex</td></tr>
                <tr><td><strong class="text-leftzinho">Cor</strong>: Branco</td></tr>
                <tr><td><strong class="text-leftzinho">Capacidade</strong>: 5 cap</td></tr>
                <tr><td><strong class="text-leftzinho">Ano</strong>: 2020</td></tr>
                <tr><td><strong class="text-leftzinho">Km inícial</strong>: 1.000</td></tr>
                <tr><td><strong class="text-leftzinho">Placa</strong>: BBB-1122</td></tr>
                <tr><td><strong class="text-leftzinho">Renavan</strong>: 45454545</td></tr>
                <tr><td><strong class="text-leftzinho">Responsável</strong>: Nandão</td></tr>
                <tr><td><strong class="text-leftzinho">Setor</strong>: Paulinho Maolinho</td></tr>
            </table>
        </td>

        <td class="borda">
            <p style="width: 70px; left: 5px; position:relative;">
                <span style="margin-left: 5%;">Motorista</span>
            </p>
            <table class="borda" style="margin-bottom: 0px; width:78%; left:40px; position:relative;">
                <tr><td><strong class="text-leftzinho">Proprietário</strong>: Fjmx SistemasFjmx </td></tr>
                <tr><td><strong class="text-leftzinho">Típo CNH</strong>: AB</td></tr>
                <tr><td><strong class="text-leftzinho">Validade CNH</strong>: 23/02/2022</td></tr>
                <tr><td><strong class="text-leftzinho">RG</strong>: 45.454.545-45</td></tr>
                <tr><td><strong class="text-leftzinho">CPF</strong>: 45.454.545-45</td></tr>
                                <tr><td><strong class="text-leftzinho" style="color:white;">a</strong> </td></tr>

            </table>

            <table class="borda" style="width:85%; left:30px; position:relative;">
                <tr>
                    <td><strong class="text-leftzinho">Responsável</strong>: 45.454.545-45</td>
                </tr>
                <tr>
                    <td><span class="text-leftzinho" style="color:white;">a</span> </td>
                </tr>
            </table>

            <table class="borda" style="width:85%; left:30px; position:relative;">
                <tr>
                    <td><strong class="text-leftzinho">Data da Saída</strong>: 11/09/2021</td>
                </tr>
                <tr>
                    <td><span class="text-leftzinho" style="color:white;">a</span> </td>
                </tr>
            </table>

            <table class="borda" style="width:85%; left:30px; position:relative;">
                <tr>
                    <td><strong class="text-leftzinho">Hora da Saída</strong>: 21:45</td>
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
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>KM SAIDA</strong>: 180.000 </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Qtd. Combustível</strong>: 1/4 </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Usuário</strong>: Fernando Santos Alves de Albuquerque Bragança </p></td>
    </tr>
</table>

<table class="table borda" style="margin-top: 8px;">
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
                                                <input type="radio" name="title">
                                            </td>
                                            <td><span style="margin-left: 10px;">Bom</span></td>

                                            <td>
                                                <input type="radio" name="title">
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
                                                <input type="radio" name="title">
                                            </td>
                                            <td><span style="margin-left: 10px;">Bom</span></td>

                                            <td>
                                                <input type="radio" name="title">
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
                                                <input type="radio" name="title">
                                            </td>
                                            <td><span style="margin-left: 10px;">Bom</span></td>

                                            <td>
                                                <input type="radio" name="title">
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
                                                <input type="radio" name="title">
                                            </td>
                                            <td><span style="margin-left: 10px;">Bom</span></td>

                                            <td>
                                                <input type="radio" name="title">
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
                                                <input type="radio" name="title">
                                            </td>
                                            <td><span style="margin-left: 10px;">Bom</span></td>

                                            <td>
                                                <input type="radio" name="title">
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
                                                <input type="radio" name="title">
                                            </td>
                                            <td><span style="margin-left: 10px;">Bom</span></td>

                                            <td>
                                                <input type="radio" name="title">
                                            </td>
                                            <td><span style="margin-left: 10px;">Ruim</span></td>
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
                                                <input type="radio" name="title">
                                            </td>
                                            <td><span style="margin-left: 10px;">Bom</span></td>

                                            <td>
                                                <input type="radio" name="title">
                                            </td>
                                            <td><span style="margin-left: 10px;">Ruim</span></td>
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
                                                <input type="radio" name="title">
                                            </td>
                                            <td><span style="margin-left: 10px;">Bom</span></td>

                                            <td>
                                                <input type="radio" name="title">
                                            </td>
                                            <td><span style="margin-left: 10px;">Ruim</span></td>
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
                                                <input type="radio" name="title">
                                            </td>
                                            <td><span style="margin-left: 10px;">Bom</span></td>

                                            <td>
                                                <input type="radio" name="title">
                                            </td>
                                            <td><span style="margin-left: 10px;">Ruim</span></td>
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
                                                <input type="radio" name="title">
                                            </td>
                                            <td><span style="margin-left: 10px;">Bom</span></td>

                                            <td>
                                                <input type="radio" name="title">
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
    </tr>
</table>

<table class="table borda">
    <tr>
        <td class="borda" width="100%"><p class="text-leftzinho" style="font-size: 13px;"><strong>Observação</strong>:  lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem </p></td>
        <td class="borda" width="100%"><p class="text-leftzinho" style="font-size: 13px;"><strong>Observação</strong>: lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem </p></td>
    </tr>
</table>

<table class="table borda" style="margin-top: 8px;">
    <tr>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Data Entrada</strong>: 180.000 </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Horário Entrada</strong>: 1/4 </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Km Entrada</strong>: Fernando Santos Alves de Albuquerque Bragança </p></td>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Qtd. Combustível</strong>: Fernando Santos Alves de Albuquerque Bragança </p></td>
    </tr>
</table>

<table class="table borda" style="margin-top: 8px;">
    <tr>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Relatório do Trajeto</strong>: 180.000 </p></td>
    </tr>
</table>

<table class="table borda" style="margin-top: 8px;">
    <tr>
        <td class="borda"><p class="text-leftzinho" style="font-size: 13px;"><strong>Observação</strong>: 180.000 </p></td>
    </tr>
</table>

@endsection
