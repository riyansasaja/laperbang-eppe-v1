<?php

function clear($string)
{

    $a = str_replace('/', '-', $string);
    return str_replace('.', '', $a);
}
