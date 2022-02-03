<?php
use Carbon\Carbon;
use Illuminate\Support\Str;

if (! function_exists('verifyImagePDF')) {
    function verifyImagePDF($text, $word)
    {
        $contains = Str::contains($text, $word);

        if($contains)
            return true;

        return false;
    }
}

if (! function_exists('convertTimestamp')) {
    function convertTimestamp($datetime, $format = "d/m/Y H:i:s")
    {
        date_default_timezone_set('America/Sao_Paulo');

        if ($datetime != null) {
            $tmp = strtotime($datetime);
            return date($format, $tmp);
        }
    }
}


if (! function_exists('convertTimestampToBd')) {
    function convertTimestampToBd($datetime, $format = "d-m-Y H:i:s")
    {
        date_default_timezone_set('America/Sao_Paulo');

        $data = str_replace("/", "-", $datetime);
        return date($format, strtotime($data));

    }
}

if (! function_exists('removePublicPath')) {
    function removePublicPath($url)
    {
        if (env('APP_ENV') == 'local')
            return asset($url);

        return str_replace('public/', '',asset($url));
    }
}

if (! function_exists('convertTimeToSeconds')) {
    function convertTimeToSeconds($time)
    {
        $str_time = $time;

        $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);

        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

        $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

        return $time_seconds;
    }
}

if (! function_exists('convertDateTimeToSeconds')) {
    function convertDateTimeToSeconds($datetime)
    {
        return strtotime("$datetime UTC");
    }
}

if (! function_exists('dateDaysDiff')) {
    function dateDaysDiff($datetime1, $datetime2)
    {
        $dateStart = new \DateTime($datetime1);
        $dateNow   = new \DateTime($datetime2);

        return $dateStart->diff($dateNow)->d;
    }
}

if (! function_exists('verificaDataSaidaMenorQueEntrada')) {
    function verificaDataSaidaMenorQueEntrada($dataSaida, $dateEntrada)
    {
        if(strtotime($dataSaida) > strtotime($dateEntrada)) {
            return false;
        }

        return true;
    }
}

if (! function_exists('decimal')) {
    function decimal($numero)
    {
        return number_format((float) $numero,0);
    }
}


if (! function_exists('decimalGambeta')) {
    function decimalGambeta($numero) // resolve o problema causado na formatação com jquery com moeda
    {
        $numberWithoutfinalDot = rtrim($numero);
        $numberFormatedTop = substr_replace($numberWithoutfinalDot, '.', -2, 0);
        return number_format((float) $numberFormatedTop,2);
    }
}
if (! function_exists('decimalSimples')) {
    function decimalSimples($numero) // resolve o problema causado na formatação com jquery com decimais simples
    {
        $numeroDecimal = number_format($numero, 2);
        $numberWithoutfinalDot = substr($numeroDecimal, 0, strlen($numeroDecimal) - 3);

        return $numberWithoutfinalDot;
    }
}

if (! function_exists('revisaoComKmControleFrotum')) {
    function revisaoComKmControleFrotum($controleFrotum) // resolve o problema causado na formatação com jquery com decimais simples
    {
        $a_id = $controleFrotum->id;
        $revisao_com_data = $controleFrotum->revisao_com_data;
        $revisao_com_km = $controleFrotum->revisao_com_km;
        $vencimento_licenciamento = $controleFrotum->vencimento_licenciamento;

        $color = '';
        $count = 0;
        $tres = 0;

        if (!empty($controleFrotum->revisao_com_data)) {
            $date1 = new DateTime(date('Y-m-d', strtotime(date('Y-m-d'))));
            $date2 = new DateTime(date('Y-m-d', strtotime($controleFrotum->revisao_com_data)));

            if ($date1 >= $date2) {
                $color = 'yellow';
                $count += 1;
            }
        }

        if (!empty($controleFrotum->revisao_com_km) AND $controleFrotum->revisao_com_km < $controleFrotum->km_atual) {
            $color = 'yellow';
            $count += 1;
        }

        if (!empty($controleFrotum->vencimento_licenciamento)) {
            $date1 = new DateTime(date('Y-m-d', strtotime(date('Y-m-d'))));
            $date2 = new DateTime(date('Y-m-d', strtotime($controleFrotum->vencimento_licenciamento)));

            if ($date1 >= $date2) {
                $count += 1;
                $color = 'orange';
            }

            if ($count > 1) {
                $color = 'orange-yellow';
                $tres = 1;
            }
        }

        if (!empty($controleFrotum->data_vencimento_seguro)) {
            $date1 = new DateTime(date('Y-m-d', strtotime(date('Y-m-d'))));
            $date2 = new DateTime(date('Y-m-d', strtotime($controleFrotum->data_vencimento_seguro)));

            if ($date1 >= $date2) {

                $count += 1;
                if ($color == 'yellow') {
                    $color = 'red-yellow';
                }

                if ($color == 'orange') {
                    $color = 'red-orange';
                }

                if ($date1 >= $date2 AND $color == '') {
                    $count += 1;
                    $color = 'red';
                }

                if ($tres > 0) {
                    $color = 'orange-red-yellow';
                }
            }
        }

        $count = 0;
        return $color;
    }
}

if (! function_exists('revisaoVencimentoLancamentoMultas')) {
    function revisaoVencimentoLancamentoMultas($lancamentoMulta) // resolve o problema causado na formatação com jquery com decimais simples
    {
        $pago = $lancamentoMulta->pago;
        $condutor = $lancamentoMulta->condutor_identificado;
        $data_lancamento = $lancamentoMulta->data_vencimento;

//        dd('pago: ', $pago, 'condutor', $condutor, 'data: ', $data_lancamento );

        if ($pago == 1) {
            if ($condutor == 1)
                return 'blue-gray';

            return 'gray';
        }

        if (!empty($data_lancamento)) {
            $date1 = new DateTime(date('Y-m-d', strtotime(date('Y-m-d'))));
            $date2 = new DateTime(date('Y-m-d', strtotime($lancamentoMulta->data_vencimento)));

            if ($date1 >= $date2) {
                if ($condutor == 1)
                    return 'blue-yellow';

                return 'yellow';
            }
        }

        if ($condutor == 1)
            return 'blue';
    }
}

if (! function_exists('verificaDataCNH')) {
    function verificaDataCNH($cnh_validade, $avisar_antes_qtddias)
    {
        $date1 = new DateTime(date('Y-m-d', strtotime(date('Y-m-d'))));
        $date2 = new DateTime(date('Y-m-d', strtotime($cnh_validade)));

        $days = $date1->diff($date2)->days;
//        $diff = abs(strtotime($date2) - strtotime($date1));
//
//        $years = floor($diff / (365*60*60*24));
//        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
//        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

//        printf("%d years, %d months, %d days\n", $years, $months, $days);

        if ($date1 > $date2)
            return true;

        if ($avisar_antes_qtddias >= $days)
            return true;
    }
}

    const FORNECEDOR_VISUALIZAR = 1;
    const FORNECEDOR_ADICIONAR = 2;
    const FORNECEDOR_EDITAR = 3;
    const FORNECEDOR_DELETAR = 4;
    const FORNECEDOR_RELATORIO = 5;

    const CONTROLEDEFROTAS_VISUALIZAR = 6;
    const CONTROLEDEFROTAS_ADICIONAR = 7;
    const CONTROLEDEFROTAS_EDITAR = 8;
    const CONTROLEDEFROTAS_DELETAR = 9;
    const CONTROLEDEFROTAS_RELATORIO = 10;

    const ABASTECIMENTOS_VISUALIZAR = 11;
    const ABASTECIMENTOS_ADICIONAR = 12;
    const ABASTECIMENTOS_EDITAR = 13;
    const ABASTECIMENTOS_DELETAR = 14;
    const ABASTECIMENTOS_RELATORIO = 15;

    const MOTORISTAS_VISUALIZAR = 16;
    const MOTORISTAS_ADICIONAR = 17;
    const MOTORISTAS_EDITAR = 18;
    const MOTORISTAS_DELETAR = 19;
    const MOTORISTAS_RELATORIO = 20;

    const MANUTENCAODESPESAS_VISUALIZAR = 21;
    const MANUTENCAODESPESAS_ADICIONAR = 22;
    const MANUTENCAODESPESAS_EDITAR = 23;
    const MANUTENCAODESPESAS_DELETAR = 24;
    const MANUTENCAODESPESAS_RELATORIO = 25;

    const LANCAMENTODEMULTAS_VISUALIZAR = 26;
    const LANCAMENTODEMULTAS_ADICIONAR = 27;
    const LANCAMENTODEMULTAS_EDITAR = 28;
    const LANCAMENTODEMULTAS_DELETAR = 29;
    const LANCAMENTODEMULTAS_RELATORIO = 30;

    const CONTROLEDIARIODESAIDA_VISUALIZAR = 31;
    const CONTROLEDIARIODESAIDA_ADICIONAR = 32;
    const CONTROLEDIARIODESAIDA_EDITAR = 33;
    const CONTROLEDIARIODESAIDA_DELETAR = 34;
    const CONTROLEDIARIODESAIDA_RELATORIO = 35;

    const CONTROLEDIARIODEENTRADA_VISUALIZAR = 36;
    const CONTROLEDIARIODEENTRADA_ADICIONAR = 37;
    const CONTROLEDIARIODEENTRADA_EDITAR = 38;
    const CONTROLEDIARIODEENTRADA_DELETAR = 39;
    const CONTROLEDIARIODEENTRADA_RELATORIO = 40;

    const AGENDAMENTODEVEICULOS_VISUALIZAR = 41;
    const AGENDAMENTODEVEICULOS_ADICIONAR = 42;
    const AGENDAMENTODEVEICULOS_EDITAR = 43;
    const AGENDAMENTODEVEICULOS_DELETAR = 44;
    const AGENDAMENTODEVEICULOS_RELATORIO = 45;

    const ADMINAGENDAMENTODEVEICULOS_VISUALIZAR = 46;
    const ADMINAGENDAMENTODEVEICULOS_ADICIONAR = 47;
    const ADMINAGENDAMENTODEVEICULOS_EDITAR = 48;
    const ADMINAGENDAMENTODEVEICULOS_DELETAR = 49;
    const ADMINAGENDAMENTODEVEICULOS_RELATORIO = 50;

    const VALECOMBUSTIVEISLAVAGENS_VISUALIZAR = 51;
    const VALECOMBUSTIVEISLAVAGENS_ADICIONAR = 52;
    const VALECOMBUSTIVEISLAVAGENS_EDITAR = 53;
    const VALECOMBUSTIVEISLAVAGENS_DELETAR = 54;
    const VALECOMBUSTIVEISLAVAGENS_RELATORIO = 55;

    const VEICULORESERVAENTRADA_VISUALIZAR = 56;
    const VEICULORESERVAENTRADA_ADICIONAR = 57;
    const VEICULORESERVAENTRADA_EDITAR = 58;
    const VEICULORESERVAENTRADA_DELETAR = 59;
    const VEICULORESERVAENTRADA_RELATORIO = 60;

    const VEICULORESERVADEVOLUCAO_VISUALIZAR = 61;
    const VEICULORESERVADEVOLUCAO_ADICIONAR = 62;
    const VEICULORESERVADEVOLUCAO_EDITAR = 63;
    const VEICULORESERVADEVOLUCAO_DELETAR = 64;
    const VEICULORESERVADEVOLUCAO_RELATORIO = 65;

    const ACTIVITYLOG_VISUALIZAR = 66;
    const ACTIVITYLOG_ADICIONAR = 67;
    const ACTIVITYLOG_EDITAR = 68;
    const ACTIVITYLOG_DELETAR = 69;
    const ACTIVITYLOG_RELATORIO = 70;

    const AGENDA_VISUALIZAR = 71;
    const AGENDA_ADICIONAR = 72;
    const AGENDA_EDITAR = 73; // nao esta usando, status = 0
    const AGENDA_DELETAR = 74;
    const AGENDA_RELATORIO = 75;

    const SOLICITACOES_VISUALIZAR = 76;
    const SOLICITACOES_ADICIONAR = 77;
    const SOLICITACOES_EDITAR = 78;
    const SOLICITACOES_DELETAR = 79;
    const SOLICITACOES_RELATORIO = 80;

    const TIPOSOLICITACOES_VISUALIZAR = 81;
    const TIPOSOLICITACOES_ADICIONAR = 82;
    const TIPOSOLICITACOES_EDITAR = 83;
    const TIPOSOLICITACOES_DELETAR = 84;
    const TIPOSOLICITACOES_RELATORIO = 85;
