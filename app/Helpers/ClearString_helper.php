<?php

function clear($string)
{

    $a = str_replace('/', '-', $string);
    return str_replace('.', '', $a);
}

function clearlink($string)
{

    $a = str_replace('/', '-', $string);
    return str_replace('.', '%', $a);
}

function decodelink($string)
{
    $a = str_replace('-', '/', $string);
    return str_replace('%', '.', $a);
}
