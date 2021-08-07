<?php
use Carbon\Carbon;

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
