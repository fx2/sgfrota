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